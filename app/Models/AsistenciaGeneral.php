<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsistenciaGeneral extends Model
{
    protected $table = 'asistencias_generales';
    protected $primaryKey = 'id_asistencia_gen';
    protected $fillable = ['id_grupo', 'id_alumno', 'fecha', 'estatus', 'observaciones'];

    public function alumno() {
        return $this->belongsTo(Alumno::class, 'id_alumno', 'id_alumno');
    }
}