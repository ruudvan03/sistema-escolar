<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        // Cargamos los grupos con su orientador para evitar consultas extra (Eager Loading)
        $grupos = Grupo::with('orientador')->get();
        return view('grupos.index', compact('grupos'));
    }

    public function edit($id)
    {
        $grupo = Grupo::findOrFail($id);
        
        // Obtenemos solo los usuarios que tienen el rol de 'Orientador'
        // Esto asume que tu relación en User se llama 'role' y el campo 'nombre_rol'
        $orientadores = User::whereHas('role', function($q) {
            $q->where('nombre_rol', 'Orientador');
        })->get();

        return view('grupos.edit', compact('grupo', 'orientadores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_grupo' => 'required|string|max:255',
            'id_orientador' => 'nullable|exists:users,id',
        ]);

        $grupo = Grupo::findOrFail($id);
        
        // Actualizamos todos los campos incluyendo el nuevo id_orientador
        $grupo->update($request->all());

        return redirect()->route('grupos.index')
            ->with('success', 'El grupo y su orientador han sido actualizados.');
    }
}