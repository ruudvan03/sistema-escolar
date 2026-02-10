@extends('layouts.app')

@section('content')
<div class="container mx-auto pb-10 px-4">
    <div class="mb-8">
        <h1 class="text-2xl font-black text-slate-800 italic uppercase tracking-tighter">Pase de Lista General</h1>
        <p class="text-slate-500 text-sm">Control de asistencia diaria por grupo (Orientación).</p>
    </div>

    <form method="GET" class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm mb-6 flex flex-wrap gap-4 items-end">
        <div>
            <label class="text-[10px] font-black uppercase text-slate-400 block mb-1">Seleccionar Grupo</label>
            <select name="id_grupo" class="rounded-xl border-slate-200 text-sm font-bold text-slate-700 focus:ring-blue-500">
                <option value="">Seleccione...</option>
                @foreach($grupos as $g)
                    <option value="{{ $g->id_grupo }}" {{ $grupo_id == $g->id_grupo ? 'selected' : '' }}>{{ $g->nombre_grupo }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="text-[10px] font-black uppercase text-slate-400 block mb-1">Fecha</label>
            <input type="date" name="fecha" value="{{ $fecha }}" class="rounded-xl border-slate-200 text-sm font-bold text-slate-700">
        </div>
        <button type="submit" class="px-6 py-2 bg-slate-800 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-slate-700">Cargar Alumnos</button>
    </form>

    @if($alumnos)
    <form action="{{ route('orientador.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_grupo" value="{{ $grupo_id }}">
        <input type="hidden" name="fecha" value="{{ $fecha }}">
        
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[10px] font-black uppercase text-slate-400">
                        <th class="px-8 py-5">Alumno</th>
                        <th class="px-4 py-5 text-center">Estatus de Asistencia</th>
                        <th class="px-8 py-5">Observaciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($alumnos as $ins)
                    @php $existente = $asistenciasExistentes[$ins->id_alumno] ?? null; @endphp
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-8 py-5">
                            <div class="font-bold text-slate-700 uppercase italic">{{ $ins->alumno->nombre }} {{ $ins->alumno->apellido_p }}</div>
                            <div class="text-[10px] text-slate-400 font-bold">{{ $ins->alumno->matricula }}</div>
                        </td>
                        <td class="px-4 py-5">
                            <div class="flex justify-center gap-2">
                                @foreach(['Asistencia' => 'bg-emerald-500', 'Falta' => 'bg-red-500', 'Retardo' => 'bg-amber-500', 'Justificante' => 'bg-blue-500'] as $key => $color)
                                <label class="cursor-pointer">
                                    <input type="radio" name="asistencia[{{ $ins->id_alumno }}]" value="{{ $key }}" class="hidden peer" {{ ($existente && $existente->estatus == $key) || (!$existente && $key == 'Asistencia') ? 'checked' : '' }}>
                                    <span class="px-3 py-1 rounded-lg border border-slate-200 text-[9px] font-black uppercase peer-checked:{{ $color }} peer-checked:text-white transition-all">
                                        {{ substr($key, 0, 1) }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <input type="text" name="observaciones[{{ $ins->id_alumno }}]" value="{{ $existente->observaciones ?? '' }}" placeholder="..." class="w-full border-none bg-slate-50 rounded-lg text-xs font-medium focus:ring-1 focus:ring-blue-500">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-6 bg-slate-50 border-t border-slate-200 text-right">
                <button type="submit" class="px-10 py-3 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all">
                    Guardar Pase de Lista
                </button>
            </div>
        </div>
    </form>
    @endif
</div>
@endsection