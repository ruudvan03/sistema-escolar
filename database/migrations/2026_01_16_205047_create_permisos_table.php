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
        Schema::create('permisos', function (Blueprint $table) {
            $table->id('id_permiso');
            $table->foreignId('id_rol')->constrained('roles','id_rol')->cascadeOnDelete();
            $table->foreignId('id_modulo')->constrained('modulos','id_modulo')->cascadeOnDelete();

            $table->boolean('mostrar')->default(false);
            $table->boolean('crear')->default(false);
            $table->boolean('actualizar')->default(false);
            $table->boolean('eliminar')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};
