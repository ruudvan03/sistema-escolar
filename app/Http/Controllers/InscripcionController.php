<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Alumno;
use App\Models\Grupo;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index()
    {
        // Traemos las inscripciones con sus relaciones para evitar múltiples consultas (Eager Loading)
        $inscripciones = Inscripcion::with(['alumno', 'grupo'])->paginate(10);
        return view('inscripciones.index', compact('inscripciones'));
    }

    public function create()
    {
        $alumnos = Alumno::where('estatus', 'Activo')->get();
        $grupos = Grupo::all(); 
        return view('inscripciones.create', compact('alumnos', 'grupos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_alumno' => 'required',
            'id_grupo' => 'required',
            'ciclo_escolar' => 'required',
        ]);

        // Evitar duplicados: Un alumno no puede estar dos veces en el mismo grupo en el mismo ciclo
        $existe = Inscripcion::where('id_alumno', $request->id_alumno)
                            ->where('id_grupo', $request->id_grupo)
                            ->where('ciclo_escolar', $request->ciclo_escolar)
                            ->exists();

        if ($existe) {
            return back()->with('error', 'El alumno ya está inscrito en este grupo para el ciclo seleccionado.');
        }

        Inscripcion::create($request->all());

        return redirect()->route('inscripciones.index')->with('success', 'Alumno inscrito correctamente.');
    }

    public function destroy($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion->delete();
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción eliminada.');
    }
}