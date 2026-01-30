<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Inscripcion;
use App\Models\AsignacionDocente;
use App\Models\Maestro;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    public function index(Request $request) 
    {
        $user = Auth::user();
        $misAsignaciones = [];
        $alumnos = [];

        if ($user->hasRole('Maestro')) {
            $maestro = Maestro::where('user_id', $user->id)->first();
            $misAsignaciones = AsignacionDocente::with(['materia', 'grupo'])
                ->where('id_maestro', $maestro->id_maestro)
                ->get();
        } else {
            $misAsignaciones = AsignacionDocente::with(['materia', 'grupo', 'maestro'])->get();
        }

        $asignacion_id = $request->id_asignacion;
        $parcial_id = $request->id_parcial ?? 1;

        if ($asignacion_id) {
            $asignacion = AsignacionDocente::findOrFail($asignacion_id);
            $alumnos = Inscripcion::with(['alumno', 'calificaciones' => function($q) use ($asignacion) {
                $q->where('id_asignacion', $asignacion->id_asignacion); 
            }])
            ->where('id_grupo', $asignacion->id_grupo)
            ->get();
        }

        return view('calificaciones.index', compact('misAsignaciones', 'alumnos', 'asignacion_id', 'parcial_id'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'id_parcial' => 'required|integer|exists:parciales,id_parcial',
            'id_asignacion' => 'required|exists:asignacion_docente,id_asignacion',
            'notas' => 'required|array',
            'notas.*' => 'nullable|numeric|between:0,10',
        ]);

        $asignacion = AsignacionDocente::findOrFail($request->id_asignacion);

        foreach ($request->notas as $id_inscripcion => $valor) {
            if ($valor === null || $valor === '') continue;

            Calificacion::updateOrCreate(
                [
                    'id_inscripcion' => $id_inscripcion,
                    'id_parcial'     => $request->id_parcial,
                    'id_asignacion'  => $asignacion->id_asignacion,
                ],
                ['calificacion' => $valor]
            );
        }

        return back()->with('success', 'Calificaciones actualizadas correctamente.');
    }

    public function showStudentBoleta() 
    {
        $user = Auth::user();
        $alumno = Alumno::where('user_id', $user->id)->firstOrFail();

        // Cargamos inscripciones con materia y sus 3 posibles calificaciones
        $inscripciones = Inscripcion::with(['materia', 'calificaciones'])
            ->where('id_alumno', $alumno->id_alumno)
            ->get();

        return view('alumnos.boleta', compact('alumno', 'inscripciones'));
    }
}