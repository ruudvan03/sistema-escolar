<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'id_rol'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // RELACIÓN CLAVE: Se llama role() para evitar errores en whereHas('role')
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_rol', 'id_rol');
    }

    // Relación para que el orientador sepa qué grupos tiene
    public function gruposAsignados()
    {
        return $this->hasMany(Grupo::class, 'id_orientador', 'id');
    }

    public function hasRole($roleName)
    {
        return $this->role && $this->role->nombre_rol === $roleName;
    }

    public function hasAnyRole(array $roles)
    {
        return $this->role && in_array($this->role->nombre_rol, $roles);
    }
}