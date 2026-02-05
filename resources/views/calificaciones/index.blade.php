@extends('layouts.app')

@section('header', 'Gestión de Calificaciones')

@section('content')
<div class="container mx-auto">
    {{-- Alerta de Parcial Cerrado --}}
    @if(isset($parcialSeleccionado) && !$parcialSeleccionado->estatus)
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-2xl shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
            <span class="text-xs font-black uppercase tracking-widest">Atención: Este parcial está cerrado. No se permiten ediciones.</span>
        </div>
    @endif

    {{-- Formulario de selección de materia y parcial --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 mb-6">
        <form action="{{ route('calificaciones.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Materia / Grupo</label>
                <select name="id_asignacion" class="w-full border-slate-200 rounded-xl text-sm" onchange="this.form.submit()">
                    <option value="">Seleccione una asignatura...</option>
                    @foreach($misAsignaciones as $asig)
                        <option value="{{ $asig->id_asignacion }}" {{ $asignacion_id == $asig->id_asignacion ? 'selected' : '' }}>
                            {{ $asig->materia->nombre_materia }} - {{ $asig->grupo->nombre_grupo }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Periodo Parcial</label>
                <select name="id_parcial" class="w-full border-slate-200 rounded-xl text-sm" onchange="this.form.submit()">
                    <option value="1" {{ $parcial_id == 1 ? 'selected' : '' }}>Primer Parcial</option>
                    <option value="2" {{ $parcial_id == 2 ? 'selected' : '' }}>Segundo Parcial</option>
                    <option value="3" {{ $parcial_id == 3 ? 'selected' : '' }}>Tercer Parcial</option>
                </select>
            </div>
        </form>
    </div>

    @if($asignacion_id && count($alumnos) > 0)
        <form action="{{ route('calificaciones.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_asignacion" value="{{ $asignacion_id }}">
            <input type="hidden" name="id_parcial" value="{{ $parcial_id }}">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-500">Estudiante</th>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-500 w-32">Calificación</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($alumnos as $ins)
                            @php 
                                $nota = $ins->calificaciones->first();
                                $valor = $nota ? $nota->calificacion : '';
                            @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-slate-700">{{ $ins->alumno->nombre }} {{ $ins->alumno->apellido }}</div>
                                    <div class="text-[10px] text-slate-400 font-black uppercase tracking-tighter">ID: {{ $ins->alumno->id_alumno }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <input type="number" step="0.1" min="0" max="10" 
                                           name="notas[{{ $ins->id_inscripcion }}]" 
                                           value="{{ $valor }}"
                                           class="w-full border-slate-200 rounded-lg text-sm text-center font-bold"
                                           {{ (isset($parcialSeleccionado) && !$parcialSeleccionado->estatus) ? 'disabled' : '' }}>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(isset($parcialSeleccionado) && $parcialSeleccionado->estatus)
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-black uppercase tracking-widest text-xs transition-all shadow-lg shadow-blue-500/20">
                        Guardar Calificaciones
                    </button>
                </div>
            @endif
        </form>
    @elseif($asignacion_id)
        <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-slate-300">
            <p class="text-slate-400 text-sm font-black uppercase tracking-widest">No hay alumnos inscritos en este grupo.</p>
        </div>
    @endif
</div>
@endsection