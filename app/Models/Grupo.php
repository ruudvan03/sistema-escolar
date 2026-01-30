<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';
    protected $primaryKey = 'id_grupo';

    protected $fillable = [
        'id_grado',
        'nombre_grupo',
        'turno',
        'estatus'
    ];

    public function grado() {
        return $this->belongsTo(Grado::class, 'id_grado', 'id_grado');
    }

    // RELACIÓN AÑADIDA: Conecta el grupo con sus materias/maestros asignados
    public function asignaciones() {
        return $this->hasMany(AsignacionDocente::class, 'id_grupo', 'id_grupo');
    }
}