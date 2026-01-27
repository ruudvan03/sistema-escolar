<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    public function index()
    {
        $grados = Grado::orderBy('id_grado', 'asc')->get();
        return view('grados.index', compact('grados'));
    }

    public function create()
    {
        return view('grados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_grado' => 'required|string|max:100|unique:grados,nombre_grado'
        ]);

        Grado::create($request->all());

        return redirect()->route('grados.index')->with('success', 'Grado creado correctamente.');
    }

    public function edit($id)
    {
        $grado = Grado::findOrFail($id);
        return view('grados.edit', compact('grado'));
    }

    public function update(Request $request, $id)
    {
        $grado = Grado::findOrFail($id);
        
        $request->validate([
            'nombre_grado' => 'required|string|max:100|unique:grados,nombre_grado,' . $id . ',id_grado'
        ]);

        $grado->update($request->all());

        return redirect()->route('grados.index')->with('success', 'Grado actualizado.');
    }

    public function destroy($id)
    {
        $grado = Grado::findOrFail($id);
        
        // Validación opcional: No borrar si tiene materias asignadas
        if($grado->materias()->count() > 0){
             return back()->withErrors(['error' => 'No puedes eliminar este grado porque tiene materias asignadas.']);
        }

        $grado->delete();
        return redirect()->route('grados.index')->with('success', 'Grado eliminado.');
    }
}