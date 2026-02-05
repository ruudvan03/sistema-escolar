<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcial extends Model
{
    use HasFactory;

    protected $table = 'parciales';
    protected $primaryKey = 'id_parcial';

    protected $fillable = [
        'nombre_parcial',
        'estatus' // Usaremos 1 para abierto y 0 para cerrado
    ];

    protected $casts = [
        'estatus' => 'boolean',
    ];
}