<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Maestro;
use App\Models\Alumno; 
use App\Models\Materia; 
use App\Models\Grado;
use Illuminate\Support\Facades\DB; 

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalUsuarios = User::count();
        $totalMaestros = Maestro::count();
        $totalAlumnos  = Alumno::count(); 
        $totalMaterias = Materia::count(); 
        $totalGrados   = Grado::count();

        // Enviar datos a la vista
        return view('dashboard', compact('totalAlumnos', 'totalMaestros', 'totalMaterias', 'totalUsuarios', 'totalGrados'));
    }
}