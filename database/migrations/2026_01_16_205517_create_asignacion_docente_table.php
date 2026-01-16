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
        Schema::create('asignacion_docente', function (Blueprint $table) {
            $table->id('id_asignacion');

            $table->foreignId('id_maestro')->constrained('maestros','id_maestro');
            $table->foreignId('id_materia')->constrained('materias','id_materia');
            $table->foreignId('id_grupo')->constrained('grupos','id_grupo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignacion_docente');
    }
};
