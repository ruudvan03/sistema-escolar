@extends('layouts.app')

@section('header', 'Boleta Digital')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
        <h2 class="text-3xl font-black text-slate-800 uppercase italic tracking-tighter">
            {{ $alumno->nombre }} {{ $alumno->apellido_p }} {{ $alumno->apellido_m }}
        </h2>
        <div class="flex gap-4 mt-2">
            <span class="text-xs font-bold uppercase tracking-widest bg-blue-50 text-blue-600 px-3 py-1 rounded-full border border-blue-100">
                Matrícula: {{ $alumno->matricula }}
            </span>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-900 text-white">
                <tr>
                    <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest">Asignatura</th>
                    <th class="px-4 py-5 text-center text-[10px] font-black uppercase tracking-widest">P1</th>
                    <th class="px-4 py-5 text-center text-[10px] font-black uppercase tracking-widest">P2</th>
                    <th class="px-4 py-5 text-center text-[10px] font-black uppercase tracking-widest">P3</th>
                    <th class="px-4 py-5 text-center text-[10px] font-black uppercase tracking-widest bg-blue-600">Promedio</th>
                    <th class="px-6 py-5 text-center text-[10px] font-black uppercase tracking-widest">Estatus</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($inscripciones as $ins)
                    @php
                        // Buscar la nota de cada parcial en la colección de calificaciones
                        $p1 = $ins->calificaciones->where('id_parcial', 1)->first()->calificacion ?? 0;
                        $p2 = $ins->calificaciones->where('id_parcial', 2)->first()->calificacion ?? 0;
                        $p3 = $ins->calificaciones->where('id_parcial', 3)->first()->calificacion ?? 0;
                        
                        // Cálculo del promedio simple
                        $promedio = ($p1 + $p2 + $p3) / 3;
                    @endphp
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-5 font-black text-slate-700 uppercase text-sm tracking-tighter">
                            {{ $ins->materia?->nombre_materia ?? 'Sin Materia' }}
                        </td>
                        <td class="px-4 py-5 text-center font-bold text-slate-500">{{ number_format($p1, 1) }}</td>
                        <td class="px-4 py-5 text-center font-bold text-slate-500">{{ number_format($p2, 1) }}</td>
                        <td class="px-4 py-5 text-center font-bold text-slate-500">{{ number_format($p3, 1) }}</td>
                        <td class="px-4 py-5 text-center bg-blue-50">
                            <span class="text-xl font-black {{ $promedio >= 6 ? 'text-blue-700' : 'text-red-600' }}">
                                {{ number_format($promedio, 1) }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            @if($promedio >= 6)
                                <span class="px-3 py-1 rounded-full text-[10px] font-black bg-green-100 text-green-700 uppercase">Aprobado</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-[10px] font-black bg-red-100 text-red-700 uppercase">Reprobado</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-slate-900 rounded-3xl p-6 text-white flex items-center gap-4">
        <div class="p-3 bg-blue-600 rounded-2xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <h4 class="text-xs font-black uppercase tracking-widest text-slate-400">Nota del Sistema</h4>
            <p class="text-sm text-slate-300 font-medium">El promedio final se calcula sumando los 3 parciales y dividiendo entre 3. Mínimo aprobatorio: 6.0</p>
        </div>
    </div>
</div>
@endsection