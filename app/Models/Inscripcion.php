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

    // RELACIÓN CORREGIDA: Obtiene todas las materias del grupo inscrito
    public function asignacionesDelGrupo()
    {
        return $this->hasMany(AsignacionDocente::class, 'id_grupo', 'id_grupo');
    }
}