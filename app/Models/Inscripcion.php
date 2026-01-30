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

    // RELACIONES EXISTENTES
    public function alumno() {
        return $this->belongsTo(Alumno::class, 'id_alumno', 'id_alumno');
    }

    public function grupo() {
        return $this->belongsTo(Grupo::class, 'id_grupo', 'id_grupo');
    }

    // NUEVAS RELACIONES NECESARIAS
    public function calificaciones() {
        // Una inscripción tiene muchos registros de calificación (P1, P2, P3)
        return $this->hasMany(Calificacion::class, 'id_inscripcion', 'id_inscripcion');
    }
}