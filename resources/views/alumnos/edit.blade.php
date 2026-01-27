@extends('layouts.app')

@section('header')
    Editar Alumno
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-slate-800">Editar: {{ $alumno->nombre }} {{ $alumno->apellido_p }}</h2>
            <a href="{{ route('alumnos.index') }}" class="text-slate-500 hover:text-blue-600 font-medium text-sm flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Cancelar
            </a>
        </div>

        <form action="{{ route('alumnos.update', $alumno->id_alumno) }}" method="POST" class="space-y-6">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Matrícula</label>
                    <input type="text" name="matricula" value="{{ old('matricula', $alumno->matricula) }}" required 
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none uppercase bg-slate-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Estatus</label>
                    <select name="estatus" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <option value="Activo" {{ strtolower($alumno->estatus) == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Baja" {{ strtolower($alumno->estatus) == 'baja' ? 'selected' : '' }}>Baja Temporal</option>
                        <option value="Egresado" {{ strtolower($alumno->estatus) == 'egresado' ? 'selected' : '' }}>Egresado</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $alumno->nombre) }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Apellido Paterno</label>
                    <input type="text" name="apellido_p" value="{{ old('apellido_p', $alumno->apellido_p) }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Apellido Materno</label>
                    <input type="text" name="apellido_m" value="{{ old('apellido_m', $alumno->apellido_m) }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">CURP</label>
                    <input type="text" name="curp" value="{{ old('curp', $alumno->curp) }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none uppercase">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Dirección</label>
                    <input type="text" name="direccion" value="{{ old('direccion', $alumno->direccion) }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="flex justify-end pt-6">
                <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all">
                    Actualizar Datos
                </button>
            </div>
        </form>
    </div>
</div>
@endsection