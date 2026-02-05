@extends('layouts.app')

@section('header', 'Mi Expediente Académico')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 flex flex-col md:flex-row items-center gap-6">
        <div class="w-20 h-20 rounded-2xl bg-blue-600 flex items-center justify-center text-white text-3xl font-black shadow-lg shadow-blue-200">
            {{ substr($alumno->nombre, 0, 1) }}
        </div>
        <div class="text-center md:text-left flex-1">
            <h3 class="text-2xl font-black text-slate-800 uppercase tracking-tighter italic">
                {{ $alumno->nombre }} {{ $alumno->apellido_p }} {{ $alumno->apellido_m }}
            </h3>
            <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-2">
                <span class="text-[10px] font-black px-3 py-1 bg-slate-100 text-slate-500 rounded-full uppercase tracking-widest border border-slate-200">
                    Matrícula: {{ $alumno->matricula }}
                </span>
                <span class="text-[10px] font-black px-3 py-1 bg-blue-50 text-blue-600 rounded-full uppercase tracking-widest border border-blue-100">
                    Ciclo: {{ $inscripciones->first()->ciclo_escolar ?? 'N/A' }}
                </span>
                <span class="text-[10px] font-black px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full uppercase tracking-widest border border-emerald-100">
                    Estatus: {{ $alumno->estatus }}
                </span>
            </div>
        </div>
        <a href="{{ route('alumno.boleta.pdf') }}" class="flex items-center gap-2 px-6 py-3 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-600 transition-all shadow-xl shadow-slate-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
            Descargar PDF
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Asignatura / Docente</th>
                        <th class="px-4 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center border-x border-slate-100">Parcial 1</th>
                        <th class="px-4 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center border-x border-slate-100">Parcial 2</th>
                        <th class="px-4 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center border-x border-slate-100">Parcial 3</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Promedio Final</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($inscripciones as $inscripcion)
                        @foreach($inscripcion->asignacionesDelGrupo as $asig)
                            @php
                                $n1 = $inscripcion->calificaciones->where('id_asignacion', $asig->id_asignacion)->where('id_parcial', 1)->first()->calificacion ?? 0;
                                $n2 = $inscripcion->calificaciones->where('id_asignacion', $asig->id_asignacion)->where('id_parcial', 2)->first()->calificacion ?? 0;
                                $n3 = $inscripcion->calificaciones->where('id_asignacion', $asig->id_asignacion)->where('id_parcial', 3)->first()->calificacion ?? 0;
                                
                                $promedio = ($n1 + $n2 + $n3) / 3;
                            @endphp
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="font-black text-slate-700 group-hover:text-blue-600 transition-colors italic uppercase tracking-tighter">
                                        {{ $asig->materia->nombre_materia }}
                                    </div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase mt-1">
                                        Prof. {{ $asig->maestro->nombre ?? 'Por asignar' }}
                                    </div>
                                </td>
                                <td class="px-4 py-5 text-center border-x border-slate-100 font-bold text-slate-600 italic">
                                    {{ $n1 ?: '-' }}
                                </td>
                                <td class="px-4 py-5 text-center border-x border-slate-100 font-bold text-slate-600 italic">
                                    {{ $n2 ?: '-' }}
                                </td>
                                <td class="px-4 py-5 text-center border-x border-slate-100 font-bold text-slate-600 italic">
                                    {{ $n3 ?: '-' }}
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl font-black text-sm shadow-inner 
                                        {{ $promedio < 6 ? 'bg-red-50 text-red-500 border border-red-100' : 'bg-emerald-50 text-emerald-600 border border-emerald-100' }}">
                                        {{ number_format($promedio, 1) }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection