@extends('layouts.app')

@section('header', 'Configuración de Parciales')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-500">Parcial</th>
                <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-500">Estado Actual</th>
                <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-500 text-right">Acción</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($parciales as $parcial)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4 font-bold text-slate-700">{{ $parcial->nombre_parcial }}</td>
                <td class="px-6 py-4">
                    @if($parcial->estatus)
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-black uppercase">Abierto</span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-[10px] font-black uppercase">Cerrado</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <form action="{{ route('parciales.toggle', $parcial->id_parcial) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-xs font-black uppercase tracking-widest {{ $parcial->estatus ? 'text-red-600' : 'text-blue-600' }}">
                            {{ $parcial->estatus ? 'Cerrar Periodo' : 'Abrir Periodo' }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection