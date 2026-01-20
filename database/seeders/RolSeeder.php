<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['nombre_rol' => 'Administrador'],
            ['nombre_rol' => 'Maestro'],
            ['nombre_rol' => 'Alumno / Tutor'],
        ]);
    }
}
