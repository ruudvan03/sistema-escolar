@extends('layouts.app')

@section('header')
    Inscribir Nuevo Alumno
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-slate-800">Ficha de Inscripción</h2>
            <a href="{{ route('alumnos.index') }}" class="text-slate-500 hover:text-blue-600 font-medium text-sm flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r">
                <p class="font-bold mb-1">Por favor corrige los siguientes errores:</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('alumnos.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-slate-50 p-5 rounded-lg border border-slate-200">
                <h3 class="text-slate-800 font-bold text-sm mb-4 uppercase tracking-wider border-b border-slate-200 pb-2">Identificación Escolar</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Matrícula <span class="text-red-500">*</span></label>
                        <input type="text" name="matricula" value="{{ old('matricula') }}" required 
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none uppercase" placeholder="Ej. 2026-001">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">CURP <span class="text-red-500">*</span></label>
                        <input type="text" name="curp" value="{{ old('curp') }}" required 
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none uppercase">
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-slate-800 font-bold text-sm mb-4 uppercase tracking-wider border-b border-slate-200 pb-2">Datos Personales</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nombre(s) <span class="text-red-500">*</span></label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Apellido Paterno <span class="text-red-500">*</span></label>
                        <input type="text" name="apellido_p" value="{{ old('apellido_p') }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Apellido Materno <span class="text-red-500">*</span></label>
                        <input type="text" name="apellido_m" value="{{ old('apellido_m') }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Fecha de Nacimiento <span class="text-red-500">*</span></label>
                        <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Dirección <span class="text-red-500">*</span></label>
                        <input type="text" name="direccion" value="{{ old('direccion') }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Calle, número, colonia">
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 p-5 rounded-lg border border-blue-100">
                <h3 class="text-blue-800 font-bold text-sm mb-4 uppercase tracking-wider border-b border-blue-200 pb-2">Cuenta de Acceso</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Correo Electrónico (Login) <span class="text-red-500">*</span></label>
                        <input type="email" name="correo" value="{{ old('correo') }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Contraseña Inicial <span class="text-red-500">*</span></label>
                        <input type="password" name="password" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6">
                <a href="{{ route('alumnos.index') }}" class="px-6 py-2.5 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 mr-3">Cancelar</a>
                <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all">
                    Guardar Alumno
                </button>
            </div>
        </form>
    </div>
</div>
@endsection