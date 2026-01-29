@extends('layouts.app')
@section('header', 'Historial de Asistencias')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex flex-col md:flex-row justify-between items-center gap-4">
        <form action="{{ route('asistencias.index') }}" method="GET" class="flex gap-2 w-full md:w-auto">
            <input type="date" name="fecha" value="{{ request('fecha') }}" class="rounded-lg border-slate-300 text-sm focus:ring-blue-500">
            <button type="submit" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg text-sm font-medium transition">Filtrar</button>
            @if(request('fecha'))
                <a href="{{ route('asistencias.index') }}" class="text-red-500 text-sm flex items-center hover:underline">Borrar filtro</a>
            @endif
        </form>
        
        <a href="{{ route('asistencias.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg font-bold text-sm shadow flex items-center gap-2 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Nueva Lista
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 uppercase text-xs font-bold text-slate-500 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3">Fecha</th>
                    <th class="px-6 py-3">Alumno</th>
                    <th class="px-6 py-3">Materia</th>
                    <th class="px-6 py-3 text-center">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($asistencias as $asis)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 whitespace-nowrap text-slate-500">
                        {{ \Carbon\Carbon::parse($asis->fecha)->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-3 font-medium text-slate-900">
                        {{ $asis->inscripcion->alumno->nombre ?? 'N/A' }} {{ $asis->inscripcion->alumno->apellido_p ?? '' }}
                    </td>
                    <td class="px-6 py-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-800">
                            {{ $asis->inscripcion->materia->nombre_materia ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-center">
                        @if($asis->estado == 'A') <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">Asistencia</span> @endif
                        @if($asis->estado == 'F') <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-bold">Falta</span> @endif
                        @if($asis->estado == 'R') <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-bold">Retardo</span> @endif
                        @if($asis->estado == 'J') <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-bold">Justificado</span> @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-slate-400 flex flex-col items-center">
                        <svg class="w-10 h-10 mb-2 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        No hay registros de asistencia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 bg-slate-50 border-t border-slate-200">
            {{ $asistencias->links() }}
        </div>
    </div>
</div>
@endsection