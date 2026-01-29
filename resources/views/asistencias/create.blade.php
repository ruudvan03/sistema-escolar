@extends('layouts.app')
@section('header', 'Pasar Lista')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    
    <form action="{{ route('asistencias.create') }}" method="GET" class="mb-6 pb-6 border-b border-slate-100">
        <div class="w-full md:w-1/2">
            <label class="block text-sm font-medium text-slate-700 mb-1">Selecciona el Grupo</label>
            <select name="id_grupo" class="w-full rounded-lg border-slate-300 focus:ring-blue-500" onchange="this.form.submit()">
                <option value="">-- Seleccionar Grupo --</option>
                @foreach($grupos as $grupo)
                    <option value="{{ $grupo->id_grupo }}" {{ $grupo_id == $grupo->id_grupo ? 'selected' : '' }}>
                        {{ $grupo->nombre_grupo ?? 'Grupo ' . $grupo->id_grupo }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @if($grupo_id && count($inscripciones) > 0)
        <form action="{{ route('asistencias.store') }}" method="POST">
            @csrf
            
            <div class="flex flex-col md:flex-row justify-between items-end mb-4 gap-4">
                <div>
                    <h3 class="font-bold text-lg text-slate-800">Alumnos del Grupo</h3>
                    <p class="text-sm text-slate-500">Marque la asistencia del día.</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Fecha</label>
                    <input type="date" name="fecha" value="{{ date('Y-m-d') }}" class="rounded-lg border-slate-300 text-sm">
                </div>
            </div>

            <div class="overflow-hidden border rounded-xl shadow-sm mb-6">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 border-b border-slate-200 uppercase text-xs font-bold text-slate-500">
                        <tr>
                            <th class="px-6 py-4">Alumno</th>
                            <th class="px-4 py-4 text-center text-green-600">Asist.</th>
                            <th class="px-4 py-4 text-center text-red-600">Falta</th>
                            <th class="px-4 py-4 text-center text-yellow-600">Retardo</th>
                            <th class="px-4 py-4 text-center text-blue-600">Justif.</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach($inscripciones as $inscripcion)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-3 font-medium text-slate-900">
                                {{ $inscripcion->alumno->apellido_p }} {{ $inscripcion->alumno->apellido_m }} {{ $inscripcion->alumno->nombre }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <input type="radio" name="asistencias[{{ $inscripcion->id_inscripcion }}]" value="A" checked class="w-5 h-5 text-green-600 cursor-pointer">
                            </td>
                            <td class="px-4 py-3 text-center">
                                <input type="radio" name="asistencias[{{ $inscripcion->id_inscripcion }}]" value="F" class="w-5 h-5 text-red-600 cursor-pointer">
                            </td>
                            <td class="px-4 py-3 text-center">
                                <input type="radio" name="asistencias[{{ $inscripcion->id_inscripcion }}]" value="R" class="w-5 h-5 text-yellow-500 cursor-pointer">
                            </td>
                            <td class="px-4 py-3 text-center">
                                <input type="radio" name="asistencias[{{ $inscripcion->id_inscripcion }}]" value="J" class="w-5 h-5 text-blue-500 cursor-pointer">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg">
                    Guardar
                </button>
            </div>
        </form>
    @elseif($grupo_id)
        <div class="text-center py-12 bg-slate-50 rounded-xl border-2 border-dashed border-slate-300">
            <p class="text-slate-500">No hay alumnos inscritos en este grupo.</p>
        </div>
    @endif
</div>
@endsection