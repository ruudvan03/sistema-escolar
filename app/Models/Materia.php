<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'materias';
    protected $primaryKey = 'id_materia';

    protected $fillable = [
        'nombre_materia',
        'id_grado',      
    ];

    // Relación: Una materia pertenece a un Grado
    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado', 'id_grado');
    }
}