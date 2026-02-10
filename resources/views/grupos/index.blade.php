@extends('layouts.app')
@section('header', 'Gestión de Grupos')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <p class="text-slate-500 text-sm font-medium">Lista de grupos registrados y sus orientadores responsables.</p>
        </div>
        <a href="{{ route('grupos.create') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-black text-xs uppercase tracking-widest shadow-lg shadow-blue-200 hover:bg-blue-700 transition active:scale-95">
            + Crear Nuevo Grupo
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($grupos as $grupo)
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-all group">
            <div class="flex items-center justify-between mb-4">
                <span class="bg-slate-100 text-slate-600 font-black px-3 py-1 rounded-full text-[10px] uppercase tracking-tighter">
                    {{ $grupo->grado->nombre_grado ?? 'Grado N/A' }}
                </span>
                <span class="text-slate-400 text-[10px] font-black uppercase italic tracking-widest">{{ $grupo->turno }}</span>
            </div>
            
            <h3 class="text-2xl font-black text-slate-800 italic uppercase tracking-tighter mb-1">Grupo {{ $grupo->nombre_grupo }}</h3>
            
            <div class="mt-4 p-3 bg-slate-50 rounded-2xl border border-slate-100 transition-colors group-hover:bg-blue-50 group-hover:border-blue-100">
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Orientador Asignado</p>
                @if($grupo->orientador)
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center text-[10px] text-white font-black uppercase">
                            {{ substr($grupo->orientador->name, 0, 1) }}
                        </div>
                        <span class="text-xs font-black text-slate-700 uppercase italic truncate">
                            {{ $grupo->orientador->name }}
                        </span>
                    </div>
                @else
                    <div class="flex items-center gap-2 text-red-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.268 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span class="text-[10px] font-black uppercase italic">Sin orientador</span>
                    </div>
                @endif
            </div>
            
            <div class="mt-6 pt-4 border-t border-slate-100 flex justify-between items-center">
                <div class="flex gap-4">
                    <a href="{{ route('grupos.edit', $grupo->id_grupo) }}" class="text-blue-600 text-[10px] font-black uppercase tracking-widest hover:text-blue-800 transition-colors">
                        Editar
                    </a>
                    
                    <form action="{{ route('grupos.destroy', $grupo->id_grupo) }}" method="POST" onsubmit="return confirm('¿Eliminar grupo?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 text-[10px] font-black uppercase tracking-widest hover:text-red-700 transition-colors">
                            Eliminar
                        </button>
                    </form>
                </div>

                <a href="#" class="inline-flex items-center gap-1 text-slate-800 text-[10px] font-black uppercase tracking-widest hover:gap-2 transition-all">
                    Alumnos 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection