<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id('id_alumno');
            $table->string('nombre');
            $table->string('matricula', 10)->unique()->after('id_alumno');
            $table->string('apellido_p');
            $table->string('apellido_m');
            $table->string('curp')->unique();
            $table->date('fecha_nacimiento');
            $table->string('direccion');
            $table->string('correo')->unique();
            $table->string('estatus')->default('activo');

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
