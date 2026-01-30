<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Inscripcion;
use App\Models\AsignacionDocente;
use App\Models\Maestro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $maestro = null;
        $misAsignaciones = [];
        $alumnos = [];

        // 1. Obtener las asignaciones según el ROL
        if ($user->hasRole('Maestro')) {
            $maestro = Maestro::where('id_usuario', $user->id)->first();
            $misAsignaciones = AsignacionDocente::with(['materia', 'grupo'])
                ->where('id_maestro', $maestro->id_maestro)
                ->get();
        } else {
            // Si es Administrador, puede ver todas las asignaciones
            $misAsignaciones = AsignacionDocente::with(['materia', 'grupo', 'maestro'])->get();
        }

        // 2. Variables de filtro
        $asignacion_id = $request->id_asignacion;
        $parcial_id = $request->id_parcial ?? 1;

        // 3. Si se seleccionó una asignación, traer a los alumnos de ese grupo
        if ($asignacion_id) {
            $asignacion = AsignacionDocente::findOrFail($asignacion_id);
            
            // Traemos alumnos inscritos en el grupo de la asignación
            $alumnos = Inscripcion::with(['alumno', 'calificaciones' => function($q) use ($asignacion) {
                // Solo traer calificaciones de la materia específica de esta asignación
                $q->where('id_materia', $asignacion->id_materia); 
            }])
            ->where('id_grupo', $asignacion->id_grupo)
            ->get();
        }

        return view('calificaciones.index', compact(
            'misAsignaciones', 
            'alumnos', 
            'asignacion_id', 
            'parcial_id'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'notas' => 'required|array',
            'id_parcial' => 'required|integer|between:1,3',
            'id_asignacion' => 'required'
        ]);

        $asignacion = AsignacionDocente::findOrFail($request->id_asignacion);

        foreach ($request->notas as $id_inscripcion => $valor) {
            if ($valor === null || $valor === '') continue;

            Calificacion::updateOrCreate(
                [
                    'id_inscripcion' => $id_inscripcion,
                    'id_parcial'     => $request->id_parcial,
                    'id_materia'     => $asignacion->id_materia,
                    'id_asignacion'  => $asignacion->id_asignacion,
                ],
                ['calificacion' => $valor]
            );
        }

        return back()->with('success', 'Calificaciones del Parcial ' . $request->id_parcial . ' actualizadas.');
    }
}