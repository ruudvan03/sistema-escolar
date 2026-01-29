@extends('layouts.app')

@section('header', 'Nueva Inscripción')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-slate-200">
    <h2 class="text-xl font-bold text-slate-800 mb-6 border-b pb-4">Inscribir Alumno a un Grupo</h2>

    <form action="{{ route('inscripciones.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">1. Selecciona el Alumno</label>
            <select name="id_alumno" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-white" required>
                <option value="">-- Buscar Alumno --</option>
                @foreach($alumnos as $alumno)
                    <option value="{{ $alumno->id_alumno }}">
                        {{ $alumno->matricula }} - {{ $alumno->apellido_p }} {{ $alumno->apellido_m }} {{ $alumno->nombre }}
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-slate-500 mt-1">Solo aparecen alumnos con estatus 'Activo'.</p>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">2. Selecciona el Grupo</label>
            <select name="id_grupo" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-white" required>
                <option value="">-- Seleccionar Grupo --</option>
                @foreach($grupos as $grupo)
                    <option value="{{ $grupo->id_grupo }}">
                        {{ $grupo->grado->nombre_grado }} - Grupo "{{ $grupo->nombre_grupo }}" ({{ $grupo->turno }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">3. Ciclo Escolar</label>
            <input type="text" name="ciclo_escolar" value="2026-A" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="flex justify-end pt-6 gap-3">
            <a href="{{ route('inscripciones.index') }}" class="px-5 py-2 border rounded-lg text-slate-600 hover:bg-slate-50 font-medium">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 shadow-md transition-all">
                Guardar Inscripción
            </button>
        </div>
    </form>
</div>
@endsection