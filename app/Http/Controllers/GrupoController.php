<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Grado;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        // Listamos los grupos cargando también el grado
        $grupos = Grupo::with('grado')->get();
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        // Necesitamos los grados para llenar el select
        $grados = Grado::all();
        return view('grupos.create', compact('grados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_grupo' => 'required|string|max:50',
            'turno' => 'required|string',
            'id_grado' => 'required|exists:grados,id_grado',
        ]);

        Grupo::create($request->all());

        return redirect()->route('grupos.index')->with('success', 'Grupo creado con éxito.');
    }

    public function destroy($id)
    {
        $grupo = Grupo::findOrFail($id);
        $grupo->delete();
        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado.');
    }
}