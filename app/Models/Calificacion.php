<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $table = 'calificaciones';
    protected $primaryKey = 'id_calificacion';

    protected $fillable = [
        'id_inscripcion', 
        'id_asignacion', 
        'id_parcial', 
        'calificacion'
    ];

    protected $casts = [
        'calificacion' => 'decimal:2',
    ];

    public function inscripcion() {
        return $this->belongsTo(Inscripcion::class, 'id_inscripcion', 'id_inscripcion');
    }

    public function parcial() {
        return $this->belongsTo(Parcial::class, 'id_parcial', 'id_parcial');
    }

    public function asignacion() {
        return $this->belongsTo(AsignacionDocente::class, 'id_asignacion', 'id_asignacion');
    }
}