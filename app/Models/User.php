<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_rol', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación: Un Usuario pertenece a un Rol.
     * NOTA: Se cambió de 'rol' a 'role' para que funcione el whereHas('role') del controlador.
     */
    public function role()
    {
        // belongsTo(Modelo, 'llave_foranea_en_users', 'llave_primaria_en_roles')
        return $this->belongsTo(Role::class, 'id_rol', 'id_rol');
    }

    /**
     * Relación: Un Orientador (Usuario) puede tener varios grupos a su cargo.
     */
    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'id_orientador', 'id');
    }

    // ==========================================
    //  FUNCIONES DE PERMISOS 
    // ==========================================

    /**
     * Verifica si el usuario tiene un rol específico.
     */
    public function hasRole($roleName)
    {
        // Se usa la relación 'role' corregida
        if (!$this->role) {
            return false;
        }
        return $this->role->nombre_rol === $roleName;
    }

    /**
     * Verifica si el usuario tiene CUALQUIERA de los roles en la lista.
     */
    public function hasAnyRole(array $roles)
    {
        // Se usa la relación 'role' corregida
        if (!$this->role) {
            return false;
        }
        return in_array($this->role->nombre_rol, $roles);
    }
}