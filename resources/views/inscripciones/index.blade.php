@extends('layouts.app')

@section('header', 'Control de Inscripciones')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center bg-white p-4 rounded-xl shadow-sm border border-slate-200">
        <div>
            <h3 class="font-bold text-slate-800 text-lg">Alumnos Inscritos</h3>
            <p class="text-slate-500 text-sm">Gestiona la asignación de alumnos a grupos.</p>
        </div>
        <a href="{{ route('inscripciones.create') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-bold shadow hover:bg-blue-700 transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nueva Inscripción
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 uppercase text-xs font-bold text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">Matrícula</th>
                        <th class="px-6 py-4">Alumno</th>
                        <th class="px-6 py-4">Grupo Asignado</th>
                        <th class="px-6 py-4">Ciclo</th>
                        <th class="px-6 py-4 text-center">Estatus</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($inscripciones as $ins)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-mono text-slate-500">{{ $ins->alumno->matricula ?? '---' }}</td>
                        <td class="px-6 py-4 font-bold text-slate-800">
                            {{ $ins->alumno->apellido_p }} {{ $ins->alumno->apellido_m }} {{ $ins->alumno->nombre }}
                        </td>
                        <td class="px-6 py-4">
                            @if($ins->grupo)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    {{ $ins->grupo->grado->nombre_grado ?? '' }} "{{ $ins->grupo->nombre_grupo }}"
                                </span>
                                <div class="text-xs text-slate-400 mt-1">{{ $ins->grupo->turno }}</div>
                            @else
                                <span class="text-red-400">Sin Grupo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $ins->ciclo_escolar }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 rounded text-xs font-bold {{ $ins->estatus == 'Activo' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $ins->estatus }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('inscripciones.destroy', $ins->id_inscripcion) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta inscripción? El historial de asistencias podría perderse.');">
                                @csrf @method('DELETE')
                                <button class="text-slate-400 hover:text-red-600 transition-colors" title="Eliminar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                            <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <p>No hay alumnos inscritos en ningún grupo todavía.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100 bg-slate-50">
            {{ $inscripciones->links() }}
        </div>
    </div>
</div>
@endsection