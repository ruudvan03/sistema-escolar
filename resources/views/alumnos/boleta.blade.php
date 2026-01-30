@extends('layouts.app')
@section('header', 'Mi Boleta de Calificaciones')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach($inscripciones as $ins)
        @php
            $notas = $ins->calificaciones;
            $acumulado = $notas->sum('calificacion');
            $progreso = ($acumulado / 18) * 100;
            $faltante = 18 - $acumulado;
        @endphp
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="font-black text-slate-800 text-lg uppercase">{{ $ins->materia->nombre_materia }}</h3>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Ciclo: {{ $ins->ciclo_escolar }}</p>
                </div>
                <div class="text-right">
                    <span class="text-2xl font-black {{ $acumulado >= 18 ? 'text-green-600' : 'text-indigo-600' }}">
                        {{ number_format($acumulado, 2) }}
                    </span>
                    <p class="text-[10px] text-slate-400 font-bold uppercase">Puntos Totales</p>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-2 mb-6">
                @for($i = 1; $i <= 3; $i++)
                    <div class="bg-slate-50 p-2 rounded-lg text-center border border-slate-100">
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Parcial {{ $i }}</p>
                        <p class="font-bold text-slate-700">{{ $notas->where('id_parcial', $i)->first()->calificacion ?? '---' }}</p>
                    </div>
                @endfor
            </div>

            <div class="space-y-2">
                <div class="flex justify-between text-xs font-bold uppercase">
                    <span class="text-slate-400">Meta: 18.00 pts</span>
                    <span class="{{ $acumulado >= 18 ? 'text-green-600' : 'text-amber-500' }}">
                        {{ $acumulado >= 18 ? '¡Materia Aprobada!' : 'Faltan ' . number_format($faltante, 2) . ' pts' }}
                    </span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                    <div class="h-full transition-all duration-1000 {{ $acumulado >= 18 ? 'bg-green-500' : 'bg-indigo-500' }}" 
                         style="width: {{ $progreso > 100 ? 100 : $progreso }}%"></div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection