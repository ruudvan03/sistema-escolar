<?php

namespace App\Http\Controllers;

use App\Models\AsignacionDocente;
use App\Models\Maestro;
use App\Models\Materia;
use App\Models\Grupo;
use Illuminate\Http\Request;

class AsignacionDocenteController extends Controller
{
    public function index() {
        $asignaciones = AsignacionDocente::with(['maestro', 'materia', 'grupo'])->get();
        return view('asignaciones.index', compact('asignaciones'));
    }

    public function create() {
        $maestros = Maestro::all();
        $materias = Materia::all();
        $grupos = Grupo::all();
        return view('asignaciones.create', compact('maestros', 'materias', 'grupos'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_maestro' => 'required',
            'id_materia' => 'required',
            'id_grupo' => 'required',
        ]);

        AsignacionDocente::create($request->all());

        return redirect()->route('asignaciones.index')->with('success', 'Asignación creada correctamente.');
    }
    
    public function destroy($id) {
        AsignacionDocente::findOrFail($id)->delete();
        return back()->with('success', 'Asignación eliminada.');
    }
}