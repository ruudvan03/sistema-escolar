<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecución del seeder de roles
        $this->call([
            RolSeeder::class,
        ]);

        // Creación del usuario administrador inicial
        \App\Models\User::factory()->create([
            'name' => 'administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'), 
        ]);
    }
}