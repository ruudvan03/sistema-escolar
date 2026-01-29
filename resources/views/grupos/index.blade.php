@extends('layouts.app')
@section('header', 'Gestión de Grupos')

@section('content')
<div class="space-y-6">
    <div class="flex justify-end">
        <a href="{{ route('grupos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold shadow hover:bg-blue-700 transition">
            + Crear Grupo
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($grupos as $grupo)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-2">
                <span class="bg-blue-100 text-blue-700 font-bold px-2 py-1 rounded text-xs">
                    {{ $grupo->grado->nombre_grado }}
                </span>
                <span class="text-slate-400 text-xs italic">{{ $grupo->turno }}</span>
            </div>
            
            <h3 class="text-xl font-bold text-slate-800">Grupo {{ $grupo->nombre_grupo }}</h3>
            
            <div class="mt-4 pt-4 border-t border-slate-100 flex justify-between items-center">
                <form action="{{ route('grupos.destroy', $grupo->id_grupo) }}" method="POST" onsubmit="return confirm('¿Eliminar grupo?')">
                    @csrf @method('DELETE')
                    <button class="text-red-500 text-sm font-bold hover:underline">Eliminar</button>
                </form>
                <a href="#" class="text-blue-600 text-sm font-medium">Gestionar Alumnos &rarr;</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection