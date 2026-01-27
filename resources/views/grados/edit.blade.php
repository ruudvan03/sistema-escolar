@extends('layouts.app')
@section('header', 'Editar Grado')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-slate-200">
    <h2 class="text-xl font-bold text-slate-800 mb-6">Editar Grado</h2>
    
    <form action="{{ route('grados.update', $grado->id_grado) }}" method="POST" class="space-y-6">
        @csrf @method('PUT')
        
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nombre del Grado</label>
            <input type="text" name="nombre_grado" value="{{ $grado->nombre_grado }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('grados.index') }}" class="px-4 py-2 border rounded-lg text-slate-700 hover:bg-slate-50">Cancelar</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-bold">Actualizar</button>
        </div>
    </form>
</div>
@endsection