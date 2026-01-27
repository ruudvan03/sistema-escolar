@extends('layouts.app')
@section('header', 'Grados Académicos')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex justify-between items-center bg-white p-4 rounded-xl shadow-sm border border-slate-200">
        <h3 class="text-slate-800 font-bold">Listado de Grados</h3>
        <a href="{{ route('grados.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold shadow-md transition-colors">
            + Nuevo Grado
        </a>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">Nombre del Grado</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($grados as $grado)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-mono text-sm text-slate-600">#{{ $grado->id_grado }}</td>
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $grado->nombre_grado }}</td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        <a href="{{ route('grados.edit', $grado->id_grado) }}" class="text-blue-600 hover:text-blue-900 mr-3">Editar</a>
                        <form action="{{ route('grados.destroy', $grado->id_grado) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro?');">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:text-red-900">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-6 py-8 text-center text-slate-500">No hay grados registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection