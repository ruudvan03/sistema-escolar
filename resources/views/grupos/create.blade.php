@extends('layouts.app')
@section('header', 'Nuevo Grupo')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-slate-200">
    <form action="{{ route('grupos.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nombre del Grupo</label>
            <input type="text" name="nombre_grupo" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Ej: A, B, 101..." required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Turno</label>
            <select name="turno" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="Matutino">Matutino</option>
                <option value="Vespertino">Vespertino</option>
                <option value="Nocturno">Nocturno</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Grado / Semestre</label>
            <select name="id_grado" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Seleccionar Grado --</option>
                @foreach($grados as $grado)
                    <option value="{{ $grado->id_grado }}">{{ $grado->nombre_grado }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('grupos.index') }}" class="px-4 py-2 border rounded-lg text-slate-600 hover:bg-slate-50">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 shadow-md">Guardar Grupo</button>
        </div>
    </form>
</div>
@endsection