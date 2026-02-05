<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Inscripcion;
use App\Models\AsignacionDocente;
use App\Models\Maestro;
use App\Models\Alumno;
use App\Models\Parcial;
// Importamos la librería para el PDF
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    /**
     * Muestra el panel de captura para maestros y administradores.
     */
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

        // Recuperamos el parcial para validar estatus en la vista
        $parcialSeleccionado = Parcial::find($parcial_id);

        if ($asignacion_id) {
            $asignacion = AsignacionDocente::findOrFail($asignacion_id);
            $alumnos = Inscripcion::with(['alumno', 'calificaciones' => function($q) use ($asignacion) {
                $q->where('id_asignacion', $asignacion->id_asignacion); 
            }])
            ->where('id_grupo', $asignacion->id_grupo)
            ->get();
        }

        return view('calificaciones.index', compact('misAsignaciones', 'alumnos', 'asignacion_id', 'parcial_id', 'parcialSeleccionado'));
    }

    /**
     * Guarda las calificaciones verificando que el parcial esté 'abierto'.
     */
    public function store(Request $request) 
    {
        $request->validate([
            'id_parcial' => 'required|integer|exists:parciales,id_parcial',
            'id_asignacion' => 'required|exists:asignacion_docente,id_asignacion',
            'notas' => 'required|array',
            'notas.*' => 'nullable|numeric|between:0,10',
        ]);

        $parcial = Parcial::findOrFail($request->id_parcial);
        
        // Verificación contra los valores exactos de tu SQL ('abierto' vs '0')
        if ($parcial->estatus !== 'abierto') {
            return back()->with('error', 'El parcial seleccionado está cerrado y no permite ediciones.');
        }

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

    /**
     * Muestra la boleta digital con todas las materias del alumno.
     */
    public function showStudentBoleta() 
    {
        $user = Auth::user();
        $alumno = Alumno::where('user_id', $user->id)->firstOrFail();

        // Relación corregida para traer la lista completa de materias
        $inscripciones = Inscripcion::with([
            'asignacionesDelGrupo.materia', 
            'asignacionesDelGrupo.maestro',
            'calificaciones'
        ])
        ->where('id_alumno', $alumno->id_alumno)
        ->get();

        return view('alumnos.boleta', compact('alumno', 'inscripciones'));
    }

    /**
     * Genera el PDF de la boleta con el nuevo diseño.
     */
    public function downloadBoletaPDF()
    {
        $user = Auth::user();
        $alumno = Alumno::where('user_id', $user->id)->firstOrFail();

        $inscripciones = Inscripcion::with([
            'asignacionesDelGrupo.materia', 
            'calificaciones'
        ])
        ->where('id_alumno', $alumno->id_alumno)
        ->get();

        // Se usa la vista 'alumnos.boleta_pdf' para el renderizado del documento
        $pdf = Pdf::loadView('alumnos.boleta_pdf', compact('alumno', 'inscripciones'));
        
        return $pdf->download('Boleta_'.$alumno->matricula.'.pdf');
    }

    /**
     * Gestión de parciales para el administrador.
     */
    public function parcialesIndex()
    {
        $parciales = Parcial::all();
        return view('calificaciones.parciales_config', compact('parciales'));
    }

    /**
     * Cambia el estatus entre 'abierto' y '0'.
     */
    public function toggleParcialStatus($id)
    {
        $parcial = Parcial::findOrFail($id);
        
        // Alternamos usando tus valores de BD
        $parcial->estatus = ($parcial->estatus === 'abierto') ? '0' : 'abierto';
        $parcial->save();

        $estado = ($parcial->estatus === 'abierto') ? 'ABIERTO' : 'CERRADO';
        return back()->with('success', "El parcial {$parcial->nombre_parcial} ahora está {$estado}.");
    }
}