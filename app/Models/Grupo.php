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
        'nombre_grupo',
        'turno',
        'id_grado'
    ];

    // Relación: Un grupo pertenece a un grado
    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado', 'id_grado');
    }
}