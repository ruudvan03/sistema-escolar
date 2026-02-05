@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
    <h3 class="text-xl font-black text-slate-800 uppercase mb-6">Control de Periodos</h3>
    
    <div class="divide-y divide-slate-100">
        @foreach($parciales as $p)
            <div class="py-4 flex items-center justify-between">
                <div>
                    <p class="font-bold text-slate-700">{{ $p->nombre_parcial }}</p>
                    <span class="px-2 py-1 rounded-full text-[10px] font-black uppercase {{ $p->estatus == 'abierto' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $p->estatus }}
                    </span>
                </div>
                <form action="{{ route('parciales.toggle', $p->id_parcial) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest text-white {{ $p->estatus == 'abierto' ? 'bg-slate-900' : 'bg-blue-600' }}">
                        {{ $p->estatus == 'abierto' ? 'Cerrar Periodo' : 'Abrir Periodo' }}
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
