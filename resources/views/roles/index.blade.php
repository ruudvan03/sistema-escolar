@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Roles y Permisos</h1>
            <p class="text-slate-500 mt-1">Administra quién tiene acceso al sistema.</p>
        </div>
        
        <form action="{{ route('roles.store') }}" method="POST" class="flex gap-2 w-full md:w-auto">
            @csrf
            <input type="text" name="nombre_rol" placeholder="Nuevo Rol (ej. Bibliotecario)" required
                class="px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition w-full md:w-64">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold shadow-md transition-transform hover:-translate-y-0.5 flex items-center whitespace-nowrap">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Crear Rol
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        @foreach($roles as $rol)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-lg transition-all duration-300 group relative overflow-hidden">
            
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-slate-50 rounded-full group-hover:bg-blue-50 transition-colors"></div>
            
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-xl font-bold shadow-sm">
                        {{ substr($rol->nombre_rol, 0, 1) }}
                    </div>
                    
                    @if(in_array($rol->nombre_rol, ['Administrador', 'Director']))
                        <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full font-semibold border border-purple-200">Alto Nivel</span>
                    @else
                        <span class="bg-slate-100 text-slate-600 text-xs px-2 py-1 rounded-full font-semibold border border-slate-200">Estándar</span>
                    @endif
                </div>

                <h3 class="text-xl font-bold text-slate-800 mb-2">{{ $rol->nombre_rol }}</h3>
                <p class="text-slate-500 text-sm mb-6">
                    Configura los accesos a módulos de alumnos, calificaciones y reportes para este perfil.
                </p>

                <a href="{{ route('roles.permisos', $rol->id_rol) }}" class="block w-full text-center bg-white border border-slate-300 text-slate-700 font-semibold py-2.5 rounded-lg hover:bg-slate-50 hover:border-blue-300 hover:text-blue-600 transition-all shadow-sm">
                    Gestionar Permisos →
                </a>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection