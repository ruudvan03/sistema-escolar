@extends('layouts.app')
@section('header', 'Nueva Materia')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-slate-200">
    <form action="{{ route('materias.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nombre de la Materia</label>
            <input type="text" name="nombre_materia" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required placeholder="Ej. Cálculo Diferencial">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Grado / Semestre</label>
            <select name="id_grado" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-white" required>
                <option value="">-- Selecciona un grado --</option>
                @foreach($grados as $grado)
                    <option value="{{ $grado->id_grado }}">{{ $grado->nombre_grado }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('materias.index') }}" class="px-4 py-2 border rounded-lg text-slate-700 hover:bg-slate-50">Cancelar</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-bold">Guardar Materia</button>
        </div>
    </form>
</div>
@endsection