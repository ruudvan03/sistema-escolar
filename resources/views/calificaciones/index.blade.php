@extends('layouts.app')
@section('header', 'Panel de Evaluación')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
    <form action="{{ route('calificaciones.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 pb-6 border-b">
        <div>
            <label class="block text-sm font-black text-slate-700 mb-2 uppercase">Materia y Grupo</label>
            <select name="id_asignacion" class="w-full rounded-xl border-slate-300 focus:ring-indigo-500" onchange="this.form.submit()">
                <option value="">-- Selecciona tu clase --</option>
                @foreach($misAsignaciones as $asig)
                    <option value="{{ $asig->id_asignacion }}" {{ $asignacion_id == $asig->id_asignacion ? 'selected' : '' }}>
                        {{ $asig->materia->nombre_materia }} - {{ $asig->grupo->nombre_grupo }} ({{ $asig->grupo->turno }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-black text-slate-700 mb-2 uppercase">Periodo</label>
            <select name="id_parcial" class="w-full rounded-xl border-slate-300 font-bold text-indigo-600" onchange="this.form.submit()">
                <option value="1" {{ $parcial_id == 1 ? 'selected' : '' }}>Primer Parcial</option>
                <option value="2" {{ $parcial_id == 2 ? 'selected' : '' }}>Segundo Parcial</option>
                <option value="3" {{ $parcial_id == 3 ? 'selected' : '' }}>Tercer Parcial</option>
            </select>
        </div>
    </form>

    @if($asignacion_id)
    <form action="{{ route('calificaciones.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_parcial" value="{{ $parcial_id }}">
        <input type="hidden" name="id_asignacion" value="{{ $asignacion_id }}">

        <div class="overflow-x-auto border border-slate-100 rounded-2xl">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase">Estudiante</th>
                        <th class="px-4 py-4 text-center text-xs font-black text-slate-500 uppercase">P1</th>
                        <th class="px-4 py-4 text-center text-xs font-black text-slate-500 uppercase">P2</th>
                        <th class="px-4 py-4 text-center text-xs font-black text-indigo-600 uppercase italic">Editando P{{ $parcial_id }}</th>
                        <th class="px-4 py-4 text-center text-xs font-black text-slate-500 uppercase bg-slate-100">Total (18 pts)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($alumnos as $ins)
                        @php
                            $notas = $ins->calificaciones;
                            $p1 = $notas->where('id_parcial', 1)->first()->calificacion ?? 0;
                            $p2 = $notas->where('id_parcial', 2)->first()->calificacion ?? 0;
                            $p3 = $notas->where('id_parcial', 3)->first()->calificacion ?? 0;
                            $total = $p1 + $p2 + $p3;
                            $currentNote = $notas->where('id_parcial', $parcial_id)->first()->calificacion ?? '';
                        @endphp
                        <tr class="hover:bg-indigo-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-700">{{ $ins->alumno->apellido_p }} {{ $ins->alumno->nombre }}</span>
                            </td>
                            <td class="px-4 py-4 text-center text-slate-400 font-medium">{{ number_format($p1, 1) }}</td>
                            <td class="px-4 py-4 text-center text-slate-400 font-medium">{{ number_format($p2, 1) }}</td>
                            <td class="px-4 py-4 text-center">
                                <input type="number" step="0.1" min="0" max="10" 
                                       name="notas[{{ $ins->id_inscripcion }}]" 
                                       value="{{ $currentNote }}" 
                                       class="w-20 rounded-lg border-indigo-200 focus:border-indigo-500 focus:ring-indigo-500 text-center font-black text-indigo-600 shadow-sm">
                            </td>
                            <td class="px-4 py-4 text-center bg-slate-50/50">
                                <span class="px-3 py-1 rounded-full text-sm font-black {{ $total >= 18 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ number_format($total, 1) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-10 py-3 rounded-xl font-black shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:scale-105 transition-all">
                Guardar Parcial {{ $parcial_id }}
            </button>
        </div>
    </form>
    @else
        <div class="text-center py-20">
            <div class="bg-indigo-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <h3 class="text-slate-400 font-bold uppercase tracking-widest">Esperando selección de grupo</h3>
        </div>
    @endif
</div>
@endsection