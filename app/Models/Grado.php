<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;

    protected $table = 'grados';
    protected $primaryKey = 'id_grado';
    protected $fillable = ['nombre_grado']; 

    // Relación: Un grado tiene muchas materias
    public function materias()
    {
        return $this->hasMany(Materia::class, 'id_grado', 'id_grado');
    }
}