@extends('layouts.app')

@section('header')
    Gestión de Alumnos
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-4 rounded-xl shadow-sm border border-slate-200">
        
        <form action="{{ route('alumnos.index') }}" method="GET" class="w-full md:w-96 relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por matrícula o nombre..."
                class="w-full pl-10 pr-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none text-slate-700">
            <div class="absolute left-3 top-2.5 text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </form>

        <a href="{{ route('alumnos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold shadow-md flex items-center transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nuevo Alumno
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Matrícula</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Estudiante</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Información</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Estatus</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($alumnos as $alumno)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-sm font-bold text-slate-600">
                            {{ $alumno->matricula ?? 'S/M' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-3 border border-blue-200 uppercase">
                                    {{ substr($alumno->nombre, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-slate-800">{{ $alumno->nombre }} {{ $alumno->apellido_p }} {{ $alumno->apellido_m }}</div>
                                    <div class="text-xs text-slate-500">{{ $alumno->correo }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-xs text-slate-500"><span class="font-bold">CURP:</span> {{ $alumno->curp }}</div>
                            <div class="text-xs text-slate-500"><span class="font-bold">Edad:</span> {{ \Carbon\Carbon::parse($alumno->fecha_nacimiento)->age }} años</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                {{ strtolower($alumno->estatus) == 'activo' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                {{ ucfirst($alumno->estatus) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('alumnos.edit', $alumno->id_alumno) }}" class="text-blue-600 hover:text-blue-900 font-semibold mr-3">Editar</a>
                            
                            <form action="{{ route('alumnos.destroy', $alumno->id_alumno) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este alumno? También se eliminará su usuario de acceso.');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                            No se encontraron alumnos registrados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $alumnos->links() }}
        </div>
    </div>
</div>
@endsection