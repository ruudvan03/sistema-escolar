@extends('layouts.app')

@section('header')
    Editar Docente
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-6">Actualizar Información</h2>
        
        <form action="{{ route('maestros.update', $maestro->id_maestro) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nombre Completo</label>
                <input type="text" name="nombre" value="{{ old('nombre', $maestro->nombre) }}" required 
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Correo Electrónico</label>
                    <input type="email" name="correo" value="{{ old('correo', $maestro->correo) }}" required 
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono', $maestro->telefono) }}"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('maestros.index') }}" class="text-slate-500 hover:text-slate-700 font-medium py-2">Cancelar</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-lg font-bold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all">
                    Actualizar Datos
                </button>
            </div>
        </form>
    </div>
</div>
@endsection