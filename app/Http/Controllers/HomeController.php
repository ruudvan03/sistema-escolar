<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <--- Importante agregar esto

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtenemos conteos rápidos usando Query Builder para no depender de Modelos aún
        $totalAlumnos = DB::table('alumnos')->count();
        $totalMaestros = DB::table('maestros')->count();
        $totalMaterias = DB::table('materias')->count();
        $totalUsuarios = DB::table('users')->count();

        // Retornamos la vista 'dashboard' con los datos
        return view('dashboard', compact('totalAlumnos', 'totalMaestros', 'totalMaterias', 'totalUsuarios'));
    }
}