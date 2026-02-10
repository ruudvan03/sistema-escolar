@extends('layouts.app')

@section('content')
<div class="container mx-auto pb-10 px-4">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-slate-800 italic uppercase tracking-tighter">Mi Boleta de Calificaciones</h1>
            <p class="text-slate-500 text-sm font-medium">Consulta tu rendimiento académico en tiempo real.</p>
        </div>
        
        <a href="{{ route('alumno.boleta.pdf') }}" 
           class="inline-flex items-center justify-center gap-3 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-2xl transition-all shadow-lg shadow-red-200 active:scale-95 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="text-xs font-black uppercase tracking-widest">Descargar PDF Oficial</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Promedio General</p>
            <div class="flex items-end gap-2 mt-1">
                <span class="text-4xl font-black text-slate-800 tracking-tighter">
                    {{ number_format($inscripciones->first()->promedio_general ?? 0, 1) }}
                </span>
                <span class="text-xs font-bold text-emerald-500 mb-2 uppercase italic">Global</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Materias Inscritas</p>
            <div class="text-4xl font-black text-slate-800 mt-1 tracking-tighter">
                {{ $inscripciones->first()->asignacionesDelGrupo->count() ?? 0 }}
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Estatus del Ciclo</p>
            <div class="mt-2">
                <span class="px-4 py-1.5 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase tracking-tight">
                    Alumno Regular
                </span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400">Asignatura / Docente</th>
                        <th class="px-4 py-5 text-[10px] font-black uppercase text-slate-400 text-center border-x border-slate-100/50">Parcial 1</th>
                        <th class="px-4 py-5 text-[10px] font-black uppercase text-slate-400 text-center border-x border-slate-100/50">Parcial 2</th>
                        <th class="px-4 py-5 text-[10px] font-black uppercase text-slate-400 text-center border-x border-slate-100/50">Parcial 3</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 text-center">Final</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($inscripciones as $inscripcion)
                        @foreach($inscripcion->asignacionesDelGrupo as $asig)
                            @php
                                $p1 = $inscripcion->calificaciones->where('id_asignacion', $asig->id_asignacion)->where('id_parcial', 1)->first();
                                $p2 = $inscripcion->calificaciones->where('id_asignacion', $asig->id_asignacion)->where('id_parcial', 2)->first();
                                $p3 = $inscripcion->calificaciones->where('id_asignacion', $asig->id_asignacion)->where('id_parcial', 3)->first();
                                
                                $n1 = $p1 ? $p1->calificacion : null;
                                $n2 = $p2 ? $p2->calificacion : null;
                                $n3 = $p3 ? $p3->calificacion : null;

                                $promedio = ($n1 !== null && $n2 !== null && $n3 !== null) ? ($n1 + $n2 + $n3) / 3 : null;
                            @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="font-black text-slate-700 italic uppercase tracking-tighter text-base group-hover:text-blue-600 transition-colors">
                                        {{ $asig->materia->nombre_materia }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">
                                        {{ $asig->maestro->nombre ?? 'Docente no asignado' }}
                                    </div>
                                </td>
                                
                                <td class="px-4 py-5 text-center font-bold text-slate-600 border-x border-slate-50">
                                    {!! $n1 !== null ? number_format($n1, 1) : '<span class="text-slate-300 font-medium text-[9px] uppercase tracking-tighter italic">Pendiente</span>' !!}
                                </td>
                                <td class="px-4 py-5 text-center font-bold text-slate-600 border-x border-slate-50">
                                    {!! $n2 !== null ? number_format($n2, 1) : '<span class="text-slate-300 font-medium text-[9px] uppercase tracking-tighter italic">Pendiente</span>' !!}
                                </td>
                                <td class="px-4 py-5 text-center font-bold text-slate-600 border-x border-slate-50">
                                    {!! $n3 !== null ? number_format($n3, 1) : '<span class="text-slate-300 font-medium text-[9px] uppercase tracking-tighter italic">Pendiente</span>' !!}
                                </td>
                                
                                <td class="px-8 py-5 text-center">
                                    @if($promedio !== null)
                                        <span class="inline-flex items-center justify-center w-12 h-8 rounded-xl font-black text-xs shadow-sm {{ $promedio < 6 ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-indigo-50 text-indigo-600 border border-indigo-100' }}">
                                            {{ number_format($promedio, 1) }}
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-slate-100 text-slate-400 text-[9px] font-black uppercase rounded-lg tracking-tighter">En curso</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <p class="text-slate-400 font-black uppercase tracking-widest text-sm italic">No se encontraron inscripciones activas.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection