<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumno;
use App\Models\Maestro;
use App\Models\Materia;
use App\Models\Grupo;
use App\Models\User;
use App\Models\Role;
use App\Models\Inscripcion;
use App\Models\Parcial;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // Inicializamos los datos para evitar errores de variable no definida
        $data = [
            'alumnos_count' => 0,
            'maestros_count' => 0,
            'materias_count' => 0,
            'grupos_count' => 0,
            'users_count' => 0,
            'roles_count' => 0,
            'promedio_general' => 0,
            'total_materias' => 0,
            'materias_aprobadas' => 0,
            'inscripciones_recientes' => collect(),
            'parciales' => collect(),
        ];

        // DATOS PARA ADMINISTRADOR
        if ($user->hasRole('Administrador')) {
            $data['alumnos_count']  = Alumno::count();
            $data['maestros_count'] = Maestro::count();
            $data['materias_count'] = Materia::count();
            $data['grupos_count']   = Grupo::count();
            $data['users_count']    = User::count();
            $data['roles_count']    = Role::count();
            $data['parciales']      = Parcial::all();
            
            // Inscripciones con Eager Loading para evitar lentitud
            $data['inscripciones_recientes'] = Inscripcion::with(['alumno', 'grupo'])
                ->latest()
                ->take(5)
                ->get();
        }

        // DATOS PARA ALUMNO
        if ($user->hasRole('Alumno/Tutor')) {
            $alumno = Alumno::where('user_id', $user->id)->first();
            if ($alumno) {
                $inscripciones = Inscripcion::with('calificaciones')
                    ->where('id_alumno', $alumno->id_alumno)
                    ->get();

                $data['total_materias'] = $inscripciones->count();
                $sumaPromedios = 0;

                foreach ($inscripciones as $ins) {
                    $prom = $ins->promedio; 
                    $sumaPromedios += $prom;
                    if ($prom >= 6) $data['materias_aprobadas']++;
                }

                $data['promedio_general'] = $data['total_materias'] > 0 ? $sumaPromedios / $data['total_materias'] : 0;
            }
        }

        return view('dashboard', compact('data'));
    }
}