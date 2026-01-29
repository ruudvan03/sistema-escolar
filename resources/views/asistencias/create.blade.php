@extends('layouts.app')
@section('header', 'Pasar Lista')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <form action="{{ route('asistencias.create') }}" method="GET" class="mb-6 pb-6 border-b">
        <div class="w-full md:w-1/2">
            <label class="block text-sm font-bold text-slate-700 mb-1">Seleccionar Grupo</label>
            <select name="id_grupo" class="w-full rounded-lg border-slate-300" onchange="this.form.submit()">
                <option value="">-- Seleccione un grupo --</option>
                @foreach($grupos as $grupo)
                    <option value="{{ $grupo->id_grupo }}" {{ $grupo_id == $grupo->id_grupo ? 'selected' : '' }}>
                        {{ $grupo->grado->nombre_grado }} - {{ $grupo->nombre_grupo }} ({{ $grupo->turno }})
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @if($grupo_id && count($inscripciones) > 0)
        <form action="{{ route('asistencias.store') }}" method="POST">
            @csrf
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-slate-800">Alumnos en lista</h3>
                <input type="date" name="fecha" value="{{ date('Y-m-d') }}" class="rounded-lg border-slate-300 shadow-sm">
            </div>

            <div class="overflow-hidden border rounded-xl">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b uppercase text-xs font-bold text-slate-500">
                        <tr>
                            <th class="px-6 py-4">Nombre del Alumno</th>
                            <th class="px-4 py-4 text-center text-green-600">A</th>
                            <th class="px-4 py-4 text-center text-red-600">F</th>
                            <th class="px-4 py-4 text-center text-yellow-600">R</th>
                            <th class="px-4 py-4 text-center text-blue-600">J</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($inscripciones as $ins)
                        <tr>
                            <td class="px-6 py-3 font-medium text-slate-900">
                                {{ $ins->alumno->apellido_p }} {{ $ins->alumno->apellido_m }} {{ $ins->alumno->nombre }}
                            </td>
                            <td class="px-4 py-3 text-center bg-green-50/20">
                                <input type="radio" name="asistencias[{{ $ins->id_inscripcion }}]" value="A" checked class="w-5 h-5 text-green-600">
                            </td>
                            <td class="px-4 py-3 text-center bg-red-50/20">
                                <input type="radio" name="asistencias[{{ $ins->id_inscripcion }}]" value="F" class="w-5 h-5 text-red-600">
                            </td>
                            <td class="px-4 py-3 text-center bg-yellow-50/20">
                                <input type="radio" name="asistencias[{{ $ins->id_inscripcion }}]" value="R" class="w-5 h-5 text-yellow-500">
                            </td>
                            <td class="px-4 py-3 text-center bg-blue-50/20">
                                <input type="radio" name="asistencias[{{ $ins->id_inscripcion }}]" value="J" class="w-5 h-5 text-blue-500">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-8 rounded-lg shadow-lg">
                    Guardar lista de hoy
                </button>
            </div>
        </form>
    @endif
</div>
@endsection