<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Grado; 
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index(Request $request)
    {
        $query = Materia::with('grado'); // Traemos la relación para mostrar el nombre del grado

        if ($request->has('search')) {
            $s = $request->search;
            $query->where('nombre_materia', 'LIKE', "%{$s}%");
        }

        $materias = $query->orderBy('id_materia', 'desc')->paginate(10);
        return view('materias.index', compact('materias'));
    }

    public function create()
    {
        // Necesitamos la lista de grados para el <select>
        $grados = Grado::all(); 
        return view('materias.create', compact('grados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_materia' => 'required|string|max:255',
            'id_grado' => 'required|exists:grados,id_grado', // Valida que el grado exista
        ]);

        Materia::create($request->all());

        return redirect()->route('materias.index')->with('success', 'Materia registrada.');
    }

    public function edit($id)
    {
        $materia = Materia::findOrFail($id);
        $grados = Grado::all(); // También aquí para editar
        return view('materias.edit', compact('materia', 'grados'));
    }

    public function update(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);

        $request->validate([
            'nombre_materia' => 'required|string|max:255',
            'id_grado' => 'required|exists:grados,id_grado',
        ]);

        $materia->update($request->all());

        return redirect()->route('materias.index')->with('success', 'Materia actualizada.');
    }

    public function destroy($id)
    {
        $materia = Materia::findOrFail($id);
        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'Materia eliminada.');
    }
}