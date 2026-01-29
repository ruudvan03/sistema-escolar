<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Inscripcion;
use App\Models\Grupo; 
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        $query = Asistencia::with(['inscripcion.alumno', 'inscripcion.grupo']); // <--- Relación grupo

        if ($request->filled('fecha')) {
            $query->where('fecha', $request->fecha);
        }

        $asistencias = $query->orderBy('fecha', 'desc')->paginate(15);
        return view('asistencias.index', compact('asistencias'));
    }

    public function create(Request $request)
    {
        // 1. Traemos los GRUPOS para el select
        $grupos = Grupo::all(); 
        $inscripciones = [];
        $grupo_id = $request->get('id_grupo'); // <--- Recibimos id_grupo

        // 2. Si seleccionó grupo, buscamos por id_grupo en inscripciones
        if ($grupo_id) {
            $inscripciones = Inscripcion::with('alumno')
                            ->where('id_grupo', $grupo_id) 
                            ->get();
        }

        return view('asistencias.create', compact('grupos', 'inscripciones', 'grupo_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'asistencias' => 'required|array',
        ]);

        $fecha = $request->fecha;

        foreach ($request->asistencias as $id_inscripcion => $estado) {
            Asistencia::updateOrCreate(
                ['id_inscripcion' => $id_inscripcion, 'fecha' => $fecha],
                ['estado' => $estado]
            );
        }

        return redirect()->route('asistencias.index')->with('success', 'Lista guardada.');
    }
}