<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';
    protected $primaryKey = 'id_inscripcion';

    protected $fillable = [
        'id_alumno',
        'id_grupo',
        'ciclo_escolar',
        'estatus'
    ];

    /**
     * Atributos adicionales que se incluirán en las conversiones a Array/JSON.
     */
    protected $appends = ['promedio_general'];

    // --- RELACIONES ---

    public function alumno() {
        return $this->belongsTo(Alumno::class, 'id_alumno', 'id_alumno');
    }

    public function grupo() {
        return $this->belongsTo(Grupo::class, 'id_grupo', 'id_grupo');
    }

    public function calificaciones() {
        return $this->hasMany(Calificacion::class, 'id_inscripcion', 'id_inscripcion');
    }

    /**
     * RELACIÓN CORREGIDA: Obtiene todas las materias del grupo inscrito.
     * Permite que el alumno visualice todas las asignaturas de su grupo.
     */
    public function asignacionesDelGrupo()
    {
        return $this->hasMany(AsignacionDocente::class, 'id_grupo', 'id_grupo');
    }

    // --- ACCESORES (MODIFICACIONES NUEVAS) ---

    /**
     * Calcula el promedio general de todas las materias de esta inscripción.
     * Útil para mostrar la tarjeta de estadística global en la boleta.
     */
    public function getPromedioGeneralAttribute()
    {
        // Usamos la colección de calificaciones ya cargada en memoria
        $notas = $this->calificaciones;

        if (!$notas || $notas->isEmpty()) {
            return 0.0;
        }

        // Promediamos el valor de la columna 'calificacion' de todos los registros
        $promedio = $notas->avg('calificacion');

        return round($promedio, 1);
    }

    /**
     * Método auxiliar para obtener el promedio de una materia específica.
     * Se puede usar en la vista si prefieres lógica de modelo en lugar de filtros de colección.
     */
    public function promedioPorMateria($id_asignacion)
    {
        $notasMateria = $this->calificaciones->where('id_asignacion', $id_asignacion);
        
        if ($notasMateria->isEmpty()) {
            return null;
        }

        return round($notasMateria->avg('calificacion'), 1);
    }
}