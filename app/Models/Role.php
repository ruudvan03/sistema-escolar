<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // 1. Especificamos la tabla 
    protected $table = 'roles';

    // 2. IMPORTANTE: Especificamos la llave primaria
    protected $primaryKey = 'id_rol';

    // 3. Campos que permitimos llenar masivamente
    protected $fillable = [
        'nombre_rol'
    ];
}