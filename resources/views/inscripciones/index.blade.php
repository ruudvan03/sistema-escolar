@extends('layouts.app')
@section('header', 'Control de Inscripciones')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-4 border-b flex justify-between items-center bg-slate-50">
        <h3 class="font-bold text-slate-700">Historial de Inscripciones</h3>
        <a href="{{ route('inscripciones.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold">
            + Nueva Inscripción
        </a>
    </div>
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-100 text-slate-600 uppercase text-xs font-bold">
            <tr>
                <th class="px-6 py-4">Alumno</th>
                <th class="px-6 py-4">Grupo</th>
                <th class="px-6 py-4">Ciclo Escolar</th>
                <th class="px-6 py-4 text-center">Estatus</th>
                <th class="px-6 py-4 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($inscripciones as $ins)
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4 font-medium text-slate-900">
                    {{ $ins->alumno->nombre }} {{ $ins->alumno->apellido_p }}
                </td>
                <td class="px-6 py-4 text-slate-600">
                    {{ $ins->grupo->nombre_grupo ?? 'N/A' }}
                </td>
                <td class="px-6 py-4 text-slate-600">{{ $ins->ciclo_escolar }}</td>
                <td class="px-6 py-4 text-center">
                    <span class="px-2 py-1 rounded-full text-xs font-bold {{ $ins->estatus == 'Activo' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $ins->estatus }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <form action="{{ route('inscripciones.destroy', $ins->id_inscripcion) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:text-red-700 font-bold">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection