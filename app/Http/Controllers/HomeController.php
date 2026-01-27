<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Maestro;
use App\Models\Alumno; 
// use App\Models\Materia; // Descomenta cuando tengas el modelo Materia
use Illuminate\Support\Facades\DB; // Lo dejamos por si acaso usas DB directas

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 1. Contar usando Modelos (Recomendado)
        // Asegúrate de que estos modelos existan en app/Models/
        $totalUsuarios = User::count();
        $totalMaestros = Maestro::count();
        
        // Si ya creaste el modelo Alumno en el paso anterior:
        $totalAlumnos = Alumno::count(); 
        
        // Para Materias, como creo que aun no tienes el modelo, 
        // usamos DB directo para que no falle si la tabla existe:
        $totalMaterias = DB::table('materias')->count(); 
        // Cuando tengas el modelo Materia, cámbialo a: Materia::count();

        // 2. Enviar datos a la vista
        return view('dashboard', compact('totalAlumnos', 'totalMaestros', 'totalMaterias', 'totalUsuarios'));
    }
}