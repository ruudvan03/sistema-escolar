@extends('layouts.app')

@section('header', 'Panel de Control')

@section('content')
<div class="space-y-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div>
                <h1 class="text-2xl font-black text-slate-800">¡Hola, {{ Auth::user()->name }}!</h1>
                <p class="text-slate-500 font-medium">Panel de {{ Auth::user()->hasRole('Administrador') ? 'Administración General' : 'Gestión Docente' }}</p>
            </div>
        </div>
        <div class="text-right">
            <p class="text-sm text-slate-400 font-bold uppercase tracking-widest">{{ now()->isoFormat('LL') }}</p>
            <p class="text-indigo-600 font-bold">Ciclo Escolar 2026-A</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @if(Auth::user()->hasRole('Administrador'))
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <p class="text-xs font-bold text-slate-400 uppercase">Alumnos Activos</p>
                <div class="flex items-end justify-between mt-2">
                    <h3 class="text-3xl font-black text-slate-800">{{ \App\Models\Alumno::count() }}</h3>
                    <span class="text-blue-500 bg-blue-50 px-2 py-1 rounded-lg text-xs font-bold">Global</span>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <p class="text-xs font-bold text-slate-400 uppercase">Grupos</p>
                <div class="flex items-end justify-between mt-2">
                    <h3 class="text-3xl font-black text-slate-800">{{ \App\Models\Grupo::count() }}</h3>
                    <a href="{{ route('grupos.index') }}" class="text-indigo-600 hover:underline text-xs font-bold">Ver todos</a>
                </div>
            </div>
        @endif

        @if(Auth::user()->hasAnyRole(['Administrador', 'Maestro']))
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <p class="text-xs font-bold text-slate-400 uppercase">Pases de Lista (Hoy)</p>
                <div class="flex items-end justify-between mt-2">
                    <h3 class="text-3xl font-black text-green-600">
                        {{ \App\Models\Asistencia::where('fecha', date('Y-m-d'))->count() }}
                    </h3>
                    <svg class="w-8 h-8 text-green-100" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h.01a1 1 0 100-2H10zm3 0a1 1 0 000 2h.01a1 1 0 100-2H13zM7 13a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h.01a1 1 0 100-2H10zm3 0a1 1 0 000 2h.01a1 1 0 100-2H13z" clip-rule="evenodd"></path></svg>
                </div>
            </div>
        @endif

        @if(Auth::user()->hasRole('Alumno/Tutor'))
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <p class="text-xs font-bold text-slate-400 uppercase">Mi Estatus</p>
                <div class="mt-2">
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-bold">Alumno Regular</span>
                </div>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <h2 class="text-lg font-bold text-slate-800">Accesos Directos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if(Auth::user()->hasAnyRole(['Administrador', 'Maestro']))
                    <a href="{{ route('asistencias.create') }}" class="group bg-white p-6 rounded-2xl border border-slate-100 hover:border-indigo-500 hover:shadow-md transition-all">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-green-50 text-green-600 rounded-xl group-hover:bg-green-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">Pasar Lista</h4>
                                <p class="text-sm text-slate-500">Registrar asistencia del día</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('calificaciones.index') }}" class="group bg-white p-6 rounded-2xl border border-slate-100 hover:border-yellow-500 hover:shadow-md transition-all">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-yellow-50 text-yellow-600 rounded-xl group-hover:bg-yellow-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">Calificaciones</h4>
                                <p class="text-sm text-slate-500">Capturar parciales (18 pts)</p>
                            </div>
                        </div>
                    </a>
                @endif
                
                @if(Auth::user()->hasRole('Administrador'))
                <a href="{{ route('inscripciones.create') }}" class="group bg-white p-6 rounded-2xl border border-slate-100 hover:border-emerald-500 hover:shadow-md transition-all">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800">Inscribir Alumno</h4>
                            <p class="text-sm text-slate-500">Asignar alumno a un grupo</p>
                        </div>
                    </div>
                </a>
                @endif
            </div>
        </div>

        <div class="bg-indigo-900 rounded-3xl p-6 text-white shadow-xl shadow-indigo-200 relative overflow-hidden">
             <div class="relative z-10">
                <h3 class="text-lg font-bold mb-4">Regla de los 18 Puntos</h3>
                <p class="text-indigo-200 text-sm leading-relaxed mb-4">
                    Recuerda que para aprobar cualquier materia, el alumno debe acumular un mínimo de **18 puntos** entre los 3 parciales.
                </p>
                <div class="space-y-3 mt-6">
                    <div class="flex items-center gap-3 text-sm">
                        <span class="w-2 h-2 bg-yellow-400 rounded-full"></span>
                        <span>Parcial 1: 6.0 min</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="w-2 h-2 bg-yellow-400 rounded-full"></span>
                        <span>Parcial 2: 6.0 min</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="w-2 h-2 bg-yellow-400 rounded-full"></span>
                        <span>Parcial 3: 6.0 min</span>
                    </div>
                </div>
             </div>
             <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-indigo-800 rounded-full opacity-50"></div>
        </div>
    </div>
</div>
@endsection