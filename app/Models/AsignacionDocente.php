<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionDocente extends Model
{
    use HasFactory;

    protected $table = 'asignacion_docente'; // El nombre exacto de tu tabla
    protected $primaryKey = 'id_asignacion';

    protected $fillable = [
        'id_maestro',
        'id_materia',
        'id_grupo'
    ];

    // --- RELACIONES ---

    public function maestro() {
        return $this->belongsTo(Maestro::class, 'id_maestro', 'id_maestro');
    }

    public function materia() {
        return $this->belongsTo(Materia::class, 'id_materia', 'id_materia');
    }

    public function grupo() {
        return $this->belongsTo(Grupo::class, 'id_grupo', 'id_grupo');
    }
}