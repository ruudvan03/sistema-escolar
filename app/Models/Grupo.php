<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';
    protected $primaryKey = 'id_group'; // Asegúrate de que coincida con tu migración (id_grupo o id_group)

    protected $fillable = [
        'nombre_grupo',
        'id_grado',
        'turno',
        'id_orientador'
    ];

    // RELACIÓN CLAVE: Para evitar el error de "nombre_grado" on null
    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado', 'id_grado');
    }

    public function orientador()
    {
        return $this->belongsTo(User::class, 'id_orientador', 'id');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'id_grupo', 'id_grupo');
    }
}