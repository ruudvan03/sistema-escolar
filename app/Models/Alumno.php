<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';
    protected $primaryKey = 'id_alumno';

    // Aquí agregamos 'matricula' como nos indicaste
    protected $fillable = [
        'matricula',
        'nombre',
        'apellido_p',
        'apellido_m',
        'curp',
        'fecha_nacimiento',
        'direccion',
        'correo',
        'estatus', 
        'user_id'
    ];

    // Relación: Un alumno pertenece a un Usuario (Login)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Un pequeño ayudante para obtener el nombre completo fácilmente
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido_p} {$this->apellido_m}";
    }
}