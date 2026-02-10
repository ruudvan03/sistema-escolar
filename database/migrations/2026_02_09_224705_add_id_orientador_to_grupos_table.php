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
        Schema::table('grupos', function (Blueprint $table) {
            // Añadimos la columna id_orientador que apunta a la tabla users
            // Usamos nullable() por si hay grupos que aún no tienen orientador
            $table->unsignedBigInteger('id_orientador')->nullable()->after('nombre_grupo');

            // Creamos la llave foránea
            $table->foreign('id_orientador')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null'); // Si se borra el usuario, el grupo queda con orientador null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grupos', function (Blueprint $table) {
            // Eliminamos la llave foránea y luego la columna
            $table->dropForeign(['id_orientador']);
            $table->dropColumn('id_orientador');
        });
    }
};