@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-black text-slate-800 italic uppercase tracking-tighter">Editar Grupo: {{ $grupo->nombre_grupo }}</h1>
        <p class="text-slate-500 text-sm font-medium">Configura los detalles del grupo y asigna un orientador responsable.</p>
    </div>

    <form action="{{ route('grupos.update', $grupo->id_grupo) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 block mb-1">Nombre del Grupo</label>
                    <input type="text" name="nombre_grupo" value="{{ $grupo->nombre_grupo }}" 
                           class="w-full rounded-xl border-slate-200 text-sm font-bold text-slate-700 focus:ring-blue-500">
                </div>

                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 block mb-1">Orientador Responsable</label>
                    <select name="id_orientador" class="w-full rounded-xl border-slate-200 text-sm font-bold text-slate-700 focus:ring-blue-500">
                        <option value="">-- Sin Orientador Asignado --</option>
                        @foreach($orientadores as $orientador)
                            <option value="{{ $orientador->id }}" {{ $grupo->id_orientador == $orientador->id ? 'selected' : '' }}>
                                {{ $orientador->name }} ({{ $orientador->email }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('grupos.index') }}" class="px-6 py-3 bg-slate-100 text-slate-500 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-200 transition-all">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
                    Guardar Cambios
                </button>
            </div>
        </div>
    </form>
</div>
@endsection