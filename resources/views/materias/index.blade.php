@extends('layouts.app')
@section('header', 'Gestión de Materias')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-4 rounded-xl shadow-sm border border-slate-200">
        <form action="{{ route('materias.index') }}" method="GET" class="w-full md:w-96 relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar materia..."
                class="w-full pl-10 pr-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none">
            <div class="absolute left-3 top-2.5 text-slate-400">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </form>
        <a href="{{ route('materias.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold shadow-md transition-colors">
            + Nueva Materia
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">Nombre Materia</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">Grado / Semestre</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($materias as $materia)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $materia->nombre_materia }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">
                        {{ $materia->grado->nombre_grado ?? 'Sin grado asignado' }}
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        <a href="{{ route('materias.edit', $materia->id_materia) }}" class="text-blue-600 hover:text-blue-900 mr-3">Editar</a>
                        <form action="{{ route('materias.destroy', $materia->id_materia) }}" method="POST" class="inline" onsubmit="return confirm('¿Borrar materia?');">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:text-red-900">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-6 py-8 text-center text-slate-500">No hay materias registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $materias->links() }}</div>
    </div>
</div>
@endsection