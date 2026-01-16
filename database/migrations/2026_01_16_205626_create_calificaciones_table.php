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
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id('id_calificacion');

            $table->foreignId('id_inscripcion')->constrained('inscripciones','id_inscripcion');
            $table->foreignId('id_asignacion')->constrained('asignacion_docente','id_asignacion');
            $table->foreignId('id_parcial')->constrained('parciales','id_parcial');

            $table->decimal('calificacion',5,2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};
