<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistencias_generales', function (Blueprint $table) {
            $table->id('id_asistencia_gen');
            // Relación con el grupo
            $table->unsignedBigInteger('id_grupo');
            // Relación con el alumno
            $table->unsignedBigInteger('id_alumno');
            
            $table->date('fecha');
            $table->enum('estatus', ['Asistencia', 'Falta', 'Retardo', 'Justificante'])->default('Asistencia');
            $table->text('observaciones')->nullable();
            
            $table->timestamps();

            // Llaves foráneas 
            $table->foreign('id_grupo')->references('id_grupo')->on('grupos')->onDelete('cascade');
            $table->foreign('id_alumno')->references('id_alumno')->on('alumnos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencias_generales');
    }
};