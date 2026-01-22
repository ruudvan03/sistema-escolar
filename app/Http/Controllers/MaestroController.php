<?php

namespace App\Http\Controllers;

use App\Models\Maestro;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MaestroController extends Controller
{
    // Muestra la lista de maestros
    public function index(Request $request)
    {
        $query = Maestro::query();

        // Buscador
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('correo', 'LIKE', "%{$search}%");
        }

        // Paginación de 10 en 10
        $maestros = $query->paginate(10);
        
        return view('maestros.index', compact('maestros'));
    }

    // Muestra el formulario de creación
    public function create()
    {
        return view('maestros.create');
    }

    // Guarda el maestro y crea su usuario (SEGURIDAD CRÍTICA AQUÍ)
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:maestros,correo|unique:users,email',
            'telefono' => 'nullable|string|max:20',
            'password' => 'required|string|min:8', 
        ]);

        try {
            DB::transaction(function () use ($request) {
                
                // 1. BUSCAR ROL SEGURO
                // Buscamos explícitamente el rol con nombre 'Maestro'
                $rolMaestro = Role::where('nombre_rol', 'Maestro')->first();

                // 2. VALIDACIÓN DE SEGURIDAD
                // Si no existe el rol 'Maestro' en la BD, detenemos todo.
                // Esto evita que se asigne un ID al azar o Admin por defecto.
                if (!$rolMaestro) {
                    throw new \Exception("ERROR DE CONFIGURACIÓN: El rol 'Maestro' no existe en la base de datos. Por favor, crea el rol en el módulo de Roles antes de continuar.");
                }

                // 3. Crear el Usuario con el ID del rol Maestro
                $user = User::create([
                    'name' => $request->nombre,
                    'email' => $request->correo,
                    'password' => Hash::make($request->password),
                    'id_rol' => $rolMaestro->id_rol, // Asignación segura
                ]);

                // 4. Crear el perfil del Maestro vinculado
                Maestro::create([
                    'nombre' => $request->nombre,
                    'correo' => $request->correo,
                    'telefono' => $request->telefono,
                    'user_id' => $user->id,
                ]);
            });

            return redirect()->route('maestros.index')->with('success', 'Docente registrado correctamente (Cuenta de acceso creada).');

        } catch (\Exception $e) {
            // Si algo falla, regresamos al formulario con el error
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    // Muestra formulario de edición
    public function edit($id)
    {
        $maestro = Maestro::findOrFail($id);
        return view('maestros.edit', compact('maestro'));
    }

    // Actualiza los datos
    public function update(Request $request, $id)
    {
        $maestro = Maestro::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => ['required', 'email', Rule::unique('maestros')->ignore($maestro->id_maestro, 'id_maestro')],
            'telefono' => 'nullable|string|max:20',
        ]);

        // Actualizar tabla maestros
        $maestro->update([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
        ]);

        // Sincronizar usuario (si existe)
        if ($maestro->usuario) {
            $maestro->usuario->update([
                'name' => $request->nombre,
                'email' => $request->correo,
            ]);
        }

        return redirect()->route('maestros.index')->with('success', 'Datos del docente actualizados.');
    }

    // Elimina maestro y usuario
    public function destroy($id)
    {
        $maestro = Maestro::findOrFail($id);
        
        // Borramos primero al usuario para no dejar basura
        if ($maestro->usuario) {
            $maestro->usuario->delete();
        }
        
        $maestro->delete();
        
        return redirect()->route('maestros.index')->with('success', 'Docente y su cuenta de acceso eliminados.');
    }
}