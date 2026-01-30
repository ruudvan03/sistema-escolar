@extends('layouts.app')
@section('header', 'Nueva Asignación')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
    <h2 class="text-xl font-bold text-slate-800 mb-6 border-b pb-4">Vincular Docente con Materia y Grupo</h2>

    <form action="{{ route('asignaciones.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">1. Seleccionar Docente</label>
            <select name="id_maestro" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white" required>
                <option value="">-- Buscar Maestro --</option>
                @foreach($maestros as $maestro)
                    <option value="{{ $maestro->id_maestro }}">{{ $maestro->nombre }} {{ $maestro->apellido_p }} {{ $maestro->apellido_m }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">2. Materia</label>
                <select name="id_materia" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white" required>
                    <option value="">-- Seleccionar --</option>
                    @foreach($materias as $materia)
                        <option value="{{ $materia->id_materia }}">{{ $materia->nombre_materia }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">3. Grupo Destino</label>
                <select name="id_grupo" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white" required>
                    <option value="">-- Seleccionar --</option>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo->id_grupo }}">
                            {{ $grupo->grado->nombre_grado ?? '' }} - {{ $grupo->nombre_grupo }} ({{ $grupo->turno }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex justify-end pt-6 gap-3">
            <a href="{{ route('asignaciones.index') }}" class="px-5 py-2 border rounded-lg text-slate-600 hover:bg-slate-50 font-medium font-bold transition-all">Cancelar</a>
            <button type="submit" class="bg-indigo-600 text-white px-8 py-2 rounded-lg font-black hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">
                Confirmar Asignación
            </button>
        </div>
    </form>
</div>
@endsection