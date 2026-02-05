<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\User;
use App\Models\Role;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf; // Asegúrate de tener instalada la librería dompdf

class AlumnoController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumno::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('apellido_p', 'LIKE', "%{$search}%")
                  ->orWhere('matricula', 'LIKE', "%{$search}%");
        }

        $alumnos = $query->orderBy('id_alumno', 'desc')->paginate(10);
        return view('alumnos.index', compact('alumnos'));
    }

    public function create()
    {
        return view('alumnos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required|string|max:10|unique:alumnos,matricula',
            'nombre' => 'required|string|max:255',
            'apellido_p' => 'required|string|max:255',
            'apellido_m' => 'required|string|max:255',
            'curp' => 'required|string|max:18|unique:alumnos,curp',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'required|string|max:255',
            'correo' => 'required|email|unique:users,email', 
            'password' => 'required|string|min:8',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $rolAlumno = Role::where('nombre_rol', 'Alumno/Tutor')->first();
                
                if (!$rolAlumno) {
                    $rolAlumno = Role::where('nombre_rol', 'Alumno')->first();
                }

                if (!$rolAlumno) {
                    throw new \Exception("ERROR CRÍTICO: No se encontró el rol 'Alumno/Tutor' en la base de datos.");
                }

                $user = User::create([
                    'name' => $request->nombre . ' ' . $request->apellido_p,
                    'email' => $request->correo,
                    'password' => Hash::make($request->password),
                    'id_rol' => $rolAlumno->id_rol,
                ]);

                Alumno::create([
                    'matricula' => $request->matricula,
                    'nombre' => $request->nombre,
                    'apellido_p' => $request->apellido_p,
                    'apellido_m' => $request->apellido_m,
                    'curp' => strtoupper($request->curp),
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'direccion' => $request->direccion,
                    'correo' => $request->correo, 
                    'estatus' => 'Activo',
                    'user_id' => $user->id,
                ]);
            });

            return redirect()->route('alumnos.index')->with('success', 'Alumno inscrito correctamente.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()])->withInput();
        }
    }

    // --- NUEVAS FUNCIONES PARA BOLETA (WEB Y PDF) ---

    /**
     * Muestra la boleta detallada en el navegador (Vista Web)
     */
    public function verBoleta()
    {
        $user = Auth::user();
        $alumno = Alumno::where('user_id', $user->id)->firstOrFail();

        // Cargamos la inscripción con todas las materias (asignaciones) y sus notas
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
     * Genera y descarga el archivo oficial (Vista PDF)
     */
    public function descargarPDF()
    {
        $user = Auth::user();
        $alumno = Alumno::where('user_id', $user->id)->firstOrFail();

        $inscripciones = Inscripcion::with([
            'asignacionesDelGrupo.materia', 
            'calificaciones'
        ])
        ->where('id_alumno', $alumno->id_alumno)
        ->get();

        // Cargamos una vista simplificada optimizada para PDF
        $pdf = Pdf::loadView('alumnos.boleta_pdf', compact('alumno', 'inscripciones'));
        
        return $pdf->download('Boleta_'.$alumno->matricula.'.pdf');
    }

    // --- FUNCIONES DE EDICIÓN Y ELIMINACIÓN ---

    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('alumnos.edit', compact('alumno'));
    }

    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);

        $request->validate([
            'matricula' => ['required', Rule::unique('alumnos')->ignore($alumno->id_alumno, 'id_alumno')],
            'nombre' => 'required|string',
            'apellido_p' => 'required|string',
            'curp' => ['required', Rule::unique('alumnos')->ignore($alumno->id_alumno, 'id_alumno')],
            'estatus' => 'required|in:Activo,Baja,Egresado',
        ]);

        $alumno->update($request->except(['password', 'correo']));

        if($alumno->usuario) {
            $alumno->usuario->update([
                'name' => $request->nombre . ' ' . $request->apellido_p
            ]);
        }

        return redirect()->route('alumnos.index')->with('success', 'Datos actualizados.');
    }

    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        
        if ($alumno->usuario) {
            $alumno->usuario->delete();
        }
        
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado.');
    }
}