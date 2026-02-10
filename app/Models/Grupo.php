<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla si no sigue la convención plural de Laravel
    protected $table = 'grupos';

    // Definimos la llave primaria personalizada
    protected $primaryKey = 'id_grupo';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre_grupo',
        'grado',
        'grupo',
        'turno',
        'id_orientador', // Nuevo campo añadido
    ];

    /**
     * Relación: Un grupo pertenece a un Orientador (Usuario).
     */
    public function orientador()
    {
        // Relacionamos con el modelo User usando la llave foránea 'id_orientador'
        return $this->belongsTo(User::class, 'id_orientador');
    }

    /**
     * Relación: Un grupo tiene muchas inscripciones (alumnos).
     */
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'id_grupo');
    }

    /**
     * Relación: Un grupo tiene muchas asistencias generales.
     */
    public function asistencias()
    {
        return $this->hasMany(AsistenciaGeneral::class, 'id_grupo');
    }

    /**
     * Opcional: Relación directa con los Alumnos a través de las Inscripciones
     */
    public function alumnos()
    {
        return $this->hasManyThrough(
            Alumno::class,
            Inscripcion::class,
            'id_grupo',    // Llave foránea en tabla inscripciones
            'id_alumno',   // Llave foránea en tabla alumnos
            'id_grupo',    // Llave local en tabla grupos
            'id_alumno'    // Llave local en tabla inscripciones
        );
    }
}