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

    public function alumno() {
        return $this->belongsTo(Alumno::class, 'id_alumno', 'id_alumno');
    }

    public function grupo() {
        return $this->belongsTo(Grupo::class, 'id_grupo', 'id_grupo');
    }

    public function calificaciones() {
        return $this->hasMany(Calificacion::class, 'id_inscripcion', 'id_inscripcion');
    }

    public function materia()
    {
        return $this->hasOneThrough(
            Materia::class,
            AsignacionDocente::class,
            'id_grupo', 
            'id_materia', 
            'id_grupo',  
            'id_materia'  
        );
    }

    // ACCESOR PARA EL PROMEDIO (Optimizado)
    public function getPromedioAttribute()
    {
        // Usamos las calificaciones ya cargadas en memoria
        $notas = $this->calificaciones;

        if (!$notas || $notas->isEmpty()) {
            return 0.0;
        }

        // Filtramos en la colección de PHP, no en la BD
        $p1 = $notas->firstWhere('id_parcial', 1)->calificacion ?? 0;
        $p2 = $notas->firstWhere('id_parcial', 2)->calificacion ?? 0;
        $p3 = $notas->firstWhere('id_parcial', 3)->calificacion ?? 0;

        $resultado = ($p1 + $p2 + $p3) / 3;
        return round($resultado, 1);
    }
}