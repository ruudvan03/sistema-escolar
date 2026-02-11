<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Grupo;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsistenciaController extends Controller
{
    public function index()
    {
        // Lógica para listar asistencias previas
        return view('asistencias.index');
    }

    public function create(Request $request)
    {
        $grupo_id = $request->get('id_grupo');
        
        // CORRECCIÓN: Usamos with('grado') para evitar el error en la vista
        $grupos = Grupo::with('grado')->get();
        
        $inscripciones = [];
        
        if ($grupo_id) {
            // Cargamos alumnos inscritos en el grupo seleccionado
            $inscripciones = Inscripcion::where('id_grupo', $grupo_id)
                ->with('alumno')
                ->get();
        }

        return view('asistencias.create', compact('grupos', 'grupo_id', 'inscripciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_grupo' => 'required',
            'asistencias' => 'required|array',
        ]);

        // Aquí iría tu lógica de guardado para asistencias por materia...
        
        return redirect()->route('asistencias.index')->with('success', 'Asistencia registrada.');
    }
}