@extends('layouts.app')
@section('header', 'Historial de Asistencias')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between bg-white p-4 rounded-xl border">
        <form action="{{ route('asistencias.index') }}" method="GET" class="flex gap-2">
            <input type="date" name="fecha" value="{{ request('fecha', date('Y-m-d')) }}" class="rounded-lg border-slate-300">
            <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded-lg">Filtrar</button>
        </form>
        <a href="{{ route('asistencias.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-bold">+ Pasar Lista</a>
    </div>

    <div class="bg-white rounded-xl border overflow-hidden shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 font-bold text-slate-600 border-b">
                <tr>
                    <th class="px-6 py-4">Fecha</th>
                    <th class="px-6 py-4">Alumno</th>
                    <th class="px-6 py-4">Grupo</th>
                    <th class="px-6 py-4 text-center">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($asistencias as $asis)
                <tr>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($asis->fecha)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 font-bold">{{ $asis->inscripcion->alumno->nombre }} {{ $asis->inscripcion->alumno->apellido_p }}</td>
                    <td class="px-6 py-4">{{ $asis->inscripcion->grupo->nombre_grupo }}</td>
                    <td class="px-6 py-4 text-center">
                        @switch($asis->estado)
                            @case('A') <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-bold">Asistencia</span> @break
                            @case('F') <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-bold">Falta</span> @break
                            @case('R') <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-bold">Retardo</span> @break
                            @case('J') <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-bold">Justificado</span> @break
                        @endswitch
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection