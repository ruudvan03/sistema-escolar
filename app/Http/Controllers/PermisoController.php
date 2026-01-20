<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermisoController extends Controller
{
    /**
     * Muestra la lista de roles (Tarjetas de Alumno, Maestro, etc.)
     * Ruta: /roles
     */
    public function roles()
    {
        $roles = DB::table('roles')->get();
        return view('roles.index', compact('roles'));
    }

    /**
     * Crea un nuevo rol desde el formulario rápido
     * Ruta: POST /roles
     */
    public function storeRole(Request $request)
    {
        $request->validate([
            'nombre_rol' => 'required|string|max:50|unique:roles,nombre_rol'
        ]);

        DB::table('roles')->insert([
            'nombre_rol' => $request->nombre_rol,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    /**
     * Muestra la MATRIZ de permisos para UN rol específico
     * Ruta: /roles/{id_rol}/permisos
     */
    public function edit($id_rol)
    {
        $rol = DB::table('roles')->where('id_rol', $id_rol)->first();
        $modulos = DB::table('modulos')->get();
        
        // Obtenemos los permisos actuales de este rol
        $permisosActuales = DB::table('permisos')
            ->where('id_rol', $id_rol)
            ->get()
            ->keyBy('id_modulo'); // Indexamos por módulo para fácil acceso en la vista

        return view('roles.permisos', compact('rol', 'modulos', 'permisosActuales'));
    }

    /**
     * Guarda los cambios de la matriz de permisos
     * Ruta: POST /roles/{id_rol}/permisos
     */
    public function update(Request $request, $id_rol)
    {
        // $request->permisos es un array con la estructura: [id_modulo => [mostrar=>1, crear=>1...]]
        
        // Si no se envía nada (todas las casillas desmarcadas), limpiamos los permisos
        $permisosFormulario = $request->input('permisos', []);

        // Recorremos todos los módulos posibles para actualizar o limpiar
        $modulos = DB::table('modulos')->get();

        foreach ($modulos as $modulo) {
            $idModulo = $modulo->id_modulo;
            
            // Verificamos si vienen datos para este módulo
            $acciones = $permisosFormulario[$idModulo] ?? [];

            DB::table('permisos')->updateOrInsert(
                ['id_rol' => $id_rol, 'id_modulo' => $idModulo],
                [
                    'mostrar'    => isset($acciones['mostrar']) ? 1 : 0,
                    'crear'      => isset($acciones['crear']) ? 1 : 0,
                    'actualizar' => isset($acciones['actualizar']) ? 1 : 0,
                    'eliminar'   => isset($acciones['eliminar']) ? 1 : 0,
                    'updated_at' => now()
                ]
            );
        }

        return redirect()->route('roles.index')->with('success', 'Permisos actualizados correctamente.');
    }

    // Mantenemos index() por si acaso alguna ruta vieja lo usa, pero redirigimos a roles()
    public function index()
    {
        return redirect()->route('roles.index');
    }
}