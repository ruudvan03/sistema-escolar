<?php

namespace App\Http\Controllers;

use App\Models\AsistenciaGeneral;
use App\Models\Grupo;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrientadorController extends Controller
{
    /**
     * Muestra el pase de lista filtrado por los grupos a cargo del orientador.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Si el usuario es Administrador, puede ver todos los grupos.
        // Si es Orientador, solo ve los grupos donde id_orientador sea su ID.
        if ($user->hasRole('Administrador')) {
            $grupos = Grupo::all();
        } else {
            $grupos = Grupo::where('id_orientador', $user->id)->get();
        }

        $grupo_id = $request->id_grupo;
        $fecha = $request->fecha ?? Carbon::now()->format('Y-m-d');
        
        $alumnos = [];
        $asistenciasExistentes = collect(); 

        if ($grupo_id) {
            $alumnos = Inscripcion::with('alumno')
                ->where('id_grupo', $grupo_id)
                ->get();
            
            $asistenciasExistentes = AsistenciaGeneral::where('id_grupo', $grupo_id)
                ->where('fecha', $fecha)
                ->get()
                ->keyBy('id_alumno');
        }

        return view('orientador.pase_lista', compact(
            'grupos', 
            'alumnos', 
            'grupo_id', 
            'fecha', 
            'asistenciasExistentes'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_grupo' => 'required|exists:grupos,id_grupo',
            'fecha' => 'required|date',
            'asistencia' => 'required|array'
        ]);

        foreach ($request->asistencia as $id_alumno => $estatus) {
            AsistenciaGeneral::updateOrCreate(
                [
                    'id_alumno' => $id_alumno,
                    'fecha'     => $request->fecha,
                ],
                [
                    'id_grupo'      => $request->id_grupo,
                    'estatus'       => $estatus,
                    'observaciones' => $request->observaciones[$id_alumno] ?? null
                ]
            );
        }

        return back()->with('success', 'Asistencias procesadas correctamente.');
    }
}