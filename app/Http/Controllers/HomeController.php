<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalAlumnos = DB::table('alumnos')->count();
        $totalMaestros = DB::table('maestros')->count();
        $totalMaterias = DB::table('materias')->count();
        $totalUsuarios = DB::table('users')->count();

        // Retornamos la vista 'dashboard' con los datos
        return view('dashboard', compact('totalAlumnos', 'totalMaestros', 'totalMaterias', 'totalUsuarios'));
    }
}