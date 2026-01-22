<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    use HasFactory;

    protected $table = 'maestros';
    protected $primaryKey = 'id_maestro';

    protected $fillable = [
        'nombre',
        'telefono',
        'correo', 
        'user_id',  
    ];

    // Relación: Un maestro pertenece a un Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}