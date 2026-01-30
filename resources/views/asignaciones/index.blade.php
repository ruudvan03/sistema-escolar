@extends('layouts.app')
@section('header', 'Asignaciones Académicas')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center bg-white p-4 rounded-xl shadow-sm border border-slate-200">
        <div>
            <h3 class="font-bold text-slate-800 text-lg">Carga Académica</h3>
            <p class="text-slate-500 text-sm">Relación de Docentes, Materias y Grupos.</p>
        </div>
        <a href="{{ route('asignaciones.create') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg font-bold shadow hover:bg-indigo-700 transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nueva Asignación
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 uppercase text-xs font-bold text-slate-500 border-b">
                <tr>
                    <th class="px-6 py-4">Docente</th>
                    <th class="px-6 py-4">Materia</th>
                    <th class="px-6 py-4 text-center">Grupo</th>
                    <th class="px-6 py-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($asignaciones as $asig)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">{{ $asig->maestro->nombre }} {{ $asig->maestro->apellido_p }}</div>
                        <div class="text-xs text-slate-400">ID: {{ $asig->maestro->numero_nomina ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4 text-slate-600 font-medium">
                        {{ $asig->materia->nombre_materia }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-bold">
                            {{ $asig->grupo->nombre_grupo }} ({{ $asig->grupo->turno }})
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('asignaciones.destroy', $asig->id_asignacion) }}" method="POST" onsubmit="return confirm('¿Eliminar asignación? El maestro perderá acceso a este grupo.');">
                            @csrf @method('DELETE')
                            <button class="text-slate-400 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">No hay materias asignadas a docentes todavía.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection