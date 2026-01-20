<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermisoController extends Controller
{
    public function index()
    {
        $roles = DB::table('roles')->get();
        $modulos = DB::table('modulos')->get();
        $permisos = DB::table('permisos')->get();

        return view('permisos.index', compact(
            'roles',
            'modulos',
            'permisos'
        ));
    }

    public function store(Request $request)
    {
        foreach ($request->permisos as $idRol => $modulos) {
            foreach ($modulos as $idModulo => $acciones) {

                DB::table('permisos')->updateOrInsert(
                    [
                        'id_rol' => $idRol,
                        'id_modulo' => $idModulo,
                    ],
                    [
                        'mostrar'   => isset($acciones['mostrar']) ? 1 : 0,
                        'crear'     => isset($acciones['crear']) ? 1 : 0,
                        'actualizar'=> isset($acciones['actualizar']) ? 1 : 0,
                        'eliminar'  => isset($acciones['eliminar']) ? 1 : 0,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Permisos actualizados correctamente');
    }
}
