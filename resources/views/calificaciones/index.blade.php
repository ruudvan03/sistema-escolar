@extends('layouts.app')
@section('header', 'Panel de Evaluación')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
    <form action="{{ route('calificaciones.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 pb-8 border-b border-slate-100">
        <div>
            <label class="block text-[10px] font-black text-slate-400 mb-2 uppercase tracking-widest">Materia y Grupo</label>
            <select name="id_asignacion" class="w-full rounded-2xl border-slate-200 focus:ring-blue-500 font-bold text-slate-700" onchange="this.form.submit()">
                <option value="">-- Selecciona tu clase --</option>
                @foreach($misAsignaciones as $asig)
                    <option value="{{ $asig->id_asignacion }}" {{ $asignacion_id == $asig->id_asignacion ? 'selected' : '' }}>
                        {{ $asig->materia->nombre_materia }} - {{ $asig->grupo->nombre_grupo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-[10px] font-black text-slate-400 mb-2 uppercase tracking-widest">Periodo a Calificar</label>
            <select name="id_parcial" class="w-full rounded-2xl border-slate-200 font-black text-blue-600 uppercase" onchange="this.form.submit()">
                <option value="1" {{ $parcial_id == 1 ? 'selected' : '' }}>Primer Parcial</option>
                <option value="2" {{ $parcial_id == 2 ? 'selected' : '' }}>Segundo Parcial</option>
                <option value="3" {{ $parcial_id == 3 ? 'selected' : '' }}>Tercer Parcial</option>
            </select>
        </div>

        <div class="flex items-end">
            <div class="bg-blue-50 px-4 py-2 rounded-2xl border border-blue-100 w-full text-center">
                <p class="text-[10px] font-black text-blue-400 uppercase">Estado</p>
                <span class="text-xs font-black text-blue-600 uppercase italic">Captura Abierta</span>
            </div>
        </div>
    </form>

    @if($asignacion_id)
    <form action="{{ route('calificaciones.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_parcial" value="{{ $parcial_id }}">
        <input type="hidden" name="id_asignacion" value="{{ $asignacion_id }}">

        <div class="overflow-hidden border border-slate-100 rounded-3xl shadow-sm">
            <table class="w-full text-left">
                <thead class="bg-slate-900 text-white">
                    <tr>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest">Estudiante</th>
                        {{-- Cabeceras dinámicas: resaltan la seleccionada --}}
                        <th class="px-4 py-5 text-center text-[10px] font-black uppercase tracking-widest {{ $parcial_id == 1 ? 'bg-blue-600' : 'opacity-40' }}">P1</th>
                        <th class="px-4 py-5 text-center text-[10px] font-black uppercase tracking-widest {{ $parcial_id == 2 ? 'bg-blue-600' : 'opacity-40' }}">P2</th>
                        <th class="px-4 py-5 text-center text-[10px] font-black uppercase tracking-widest {{ $parcial_id == 3 ? 'bg-blue-600' : 'opacity-40' }}">P3</th>
                        <th class="px-4 py-5 text-center text-[10px] font-black uppercase bg-slate-800 tracking-widest">Promedio Final</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($alumnos as $ins)
                        @php
                            $notas = $ins->calificaciones;
                            $p1 = $notas->where('id_parcial', 1)->first()->calificacion ?? 0;
                            $p2 = $notas->where('id_parcial', 2)->first()->calificacion ?? 0;
                            $p3 = $notas->where('id_parcial', 3)->first()->calificacion ?? 0;
                            $promedio = ($p1 + $p2 + $p3) / 3;
                            $currentNote = $notas->where('id_parcial', $parcial_id)->first()->calificacion ?? '';
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-8 py-5">
                                <span class="block font-black text-slate-700 uppercase tracking-tighter">{{ $ins->alumno->apellido_p }} {{ $ins->alumno->nombre }}</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase">{{ $ins->alumno->matricula }}</span>
                            </td>
                            
                            {{-- Celdas de lectura (No seleccionadas) o input (Seleccionada) --}}
                            <td class="px-4 py-5 text-center font-bold {{ $parcial_id == 1 ? 'bg-blue-50/30' : 'text-slate-400 italic' }}">
                                @if($parcial_id == 1)
                                    <input type="number" step="0.1" name="notas[{{ $ins->id_inscripcion }}]" value="{{ $currentNote }}" class="w-20 rounded-xl border-blue-200 text-center font-black text-blue-600">
                                @else {{ number_format($p1, 1) }} @endif
                            </td>

                            <td class="px-4 py-5 text-center font-bold {{ $parcial_id == 2 ? 'bg-blue-50/30' : 'text-slate-400 italic' }}">
                                @if($parcial_id == 2)
                                    <input type="number" step="0.1" name="notas[{{ $ins->id_inscripcion }}]" value="{{ $currentNote }}" class="w-20 rounded-xl border-blue-200 text-center font-black text-blue-600">
                                @else {{ number_format($p2, 1) }} @endif
                            </td>

                            <td class="px-4 py-5 text-center font-bold {{ $parcial_id == 3 ? 'bg-blue-50/30' : 'text-slate-400 italic' }}">
                                @if($parcial_id == 3)
                                    <input type="number" step="0.1" name="notas[{{ $ins->id_inscripcion }}]" value="{{ $currentNote }}" class="w-20 rounded-xl border-blue-200 text-center font-black text-blue-600">
                                @else {{ number_format($p3, 1) }} @endif
                            </td>

                            <td class="px-4 py-5 text-center bg-slate-50">
                                <span class="text-sm font-black px-3 py-1 rounded-lg {{ $promedio >= 6 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ number_format($promedio, 1) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-slate-900 text-white px-12 py-4 rounded-2xl font-black shadow-xl hover:bg-blue-600 transition-all uppercase tracking-widest text-xs">
                Guardar Calificaciones P{{ $parcial_id }}
            </button>
        </div>
    </form>
    @endif
</div>
@endsection