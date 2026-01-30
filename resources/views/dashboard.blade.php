@extends('layouts.app')

@section('header')
    @if(Auth::user()->hasRole('Administrador'))
        Panel de Control
    @elseif(Auth::user()->hasRole('Maestro'))
        Portal Docente
    @else
        Mi Portal
    @endif
@endsection

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                @if(Auth::user()->hasRole('Administrador')) Resumen General @endif
                @if(Auth::user()->hasRole('Maestro')) Mis Clases y Grupos @endif
                @if(Auth::user()->hasRole('Alumno/Tutor')) Mi Progreso Académico @endif
            </h1>
            <p class="text-slate-500">
                Hola, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span>. 
                Sesión iniciada como <span class="px-2 py-0.5 rounded text-xs font-bold bg-slate-200 text-slate-700">{{ Auth::user()->rol->nombre_rol ?? 'Usuario' }}</span>
            </p>
        </div>
        <div class="flex gap-2">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700 border border-blue-100">
                <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                Ciclo Escolar 2026-A
            </span>
        </div>
    </div>

    @if(Auth::user()->hasRole('Administrador'))
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center transition-all hover:shadow-md">
                <div class="p-3 rounded-lg bg-blue-50 text-blue-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Alumnos</p>
                    <p class="text-2xl font-bold text-slate-800">{{ \App\Models\Alumno::count() }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center transition-all hover:shadow-md">
                <div class="p-3 rounded-lg bg-indigo-50 text-indigo-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Docentes</p>
                    <p class="text-2xl font-bold text-slate-800">{{ \App\Models\Maestro::count() }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center transition-all hover:shadow-md">
                <div class="p-3 rounded-lg bg-teal-50 text-teal-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Materias</p>
                    <p class="text-2xl font-bold text-slate-800">{{ \App\Models\Materia::count() }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center transition-all hover:shadow-md">
                <div class="p-3 rounded-lg bg-purple-50 text-purple-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Grupos</p>
                    <p class="text-2xl font-bold text-slate-800">{{ \App\Models\Grupo::count() }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center transition-all hover:shadow-md">
                <div class="p-3 rounded-lg bg-orange-50 text-orange-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Usuarios</p>
                    <p class="text-2xl font-bold text-slate-800">{{ \App\Models\User::count() }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-6">
            
            @if(Auth::user()->hasRole('Administrador'))
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-lg font-bold text-slate-800 mb-4">Administración del Sistema</h3>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                        <a href="{{ route('alumnos.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition-all">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-blue-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            </div>
                            <span class="text-sm font-medium text-slate-600 group-hover:text-blue-700 text-center">Alumnos</span>
                        </a>

                        <a href="{{ route('calificaciones.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-yellow-50 hover:border-yellow-200 transition-all">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-yellow-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </div>
                            <span class="text-sm font-medium text-slate-600 group-hover:text-yellow-700 text-center">Calificar</span>
                        </a>

                        <a href="{{ route('asistencias.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-emerald-50 hover:border-emerald-200 transition-all">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-emerald-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <span class="text-sm font-medium text-slate-600 group-hover:text-emerald-700 text-center">Asistencias</span>
                        </a>
                        
                        <a href="{{ route('asignaciones.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-purple-50 hover:border-purple-200 transition-all">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-purple-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            </div>
                            <span class="text-sm font-medium text-slate-600 group-hover:text-purple-700 text-center">Asignar</span>
                        </a>

                        <a href="{{ route('users.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-orange-50 hover:border-orange-200 transition-all">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-orange-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <span class="text-sm font-medium text-slate-600 group-hover:text-orange-700 text-center">Usuarios</span>
                        </a>

                        <a href="{{ route('roles.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-gray-50 hover:border-gray-200 transition-all">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-gray-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <span class="text-sm font-medium text-slate-600 group-hover:text-gray-700 text-center">Roles</span>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h3 class="font-bold text-slate-800">Inscripciones Recientes</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600">
                            <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
                                <tr>
                                    <th class="px-6 py-3">Alumno</th>
                                    <th class="px-6 py-3">Grupo</th>
                                    <th class="px-6 py-3">Estado</th>
                                    <th class="px-6 py-3">Ciclo</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach(\App\Models\Inscripcion::with(['alumno', 'grupo'])->latest()->take(5)->get() as $ins)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-3 font-medium text-slate-900">{{ $ins->alumno->apellido_p }} {{ $ins->alumno->nombre }}</td>
                                    <td class="px-6 py-3">{{ $ins->grupo->nombre_grupo }}</td>
                                    <td class="px-6 py-3">
                                        <span class="bg-green-100 text-green-700 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase">Activo</span>
                                    </td>
                                    <td class="px-6 py-3 text-slate-400 font-mono">{{ $ins->ciclo_escolar }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if(Auth::user()->hasRole('Maestro'))
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 border-l-4 border-indigo-500">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-slate-800 uppercase tracking-tight">Captura de Parciales (18 Pts)</h3>
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <p class="text-slate-500 text-sm mb-6 leading-relaxed">Selecciona uno de tus grupos asignados para subir las calificaciones de los 3 parciales. El sistema calculará automáticamente si el alumno alcanza los 18 puntos requeridos.</p>
                    <a href="{{ route('calificaciones.index') }}" class="inline-flex items-center justify-center w-full px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-black shadow-lg shadow-indigo-100 transition-all">
                        Ir a mi Registro de Notas &rarr;
                    </a>
                </div>
            @endif

            @if(Auth::user()->hasRole('Alumno/Tutor'))
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center bg-gradient-to-b from-white to-blue-50">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 text-blue-600 rounded-full mb-4 shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-2 tracking-tight">¡Bienvenido a tu Boleta Digital!</h3>
                    <p class="text-slate-500 max-w-md mx-auto mb-6">
                        Recuerda que para acreditar una materia necesitas acumular al menos **18 puntos** entre los tres parciales.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('alumno.boleta') }}" class="px-8 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">Ver Mis Calificaciones</a>
                    </div>
                </div>
            @endif
        </div>

        <div class="space-y-6">
            
            <div class="bg-indigo-600 rounded-xl shadow-lg p-6 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-lg font-bold mb-2 tracking-tighter uppercase italic">Regla de los 18</h3>
                    <p class="text-indigo-100 text-xs mb-4 leading-relaxed">P1 + P2 + P3 ≥ 18.00<br>Mínimo 6.0 por parcial para exentar.</p>
                    <div class="w-full bg-indigo-800 rounded-full h-1.5 mb-2">
                        <div class="bg-yellow-400 h-full rounded-full" style="width: 60%"></div>
                    </div>
                </div>
                <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
            </div>

            @if(Auth::user()->hasRole('Administrador'))
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-bold text-slate-800 mb-4 text-sm uppercase tracking-widest border-b pb-2">Sistema</h3>
                    <ul class="space-y-3 text-xs font-medium">
                        <li class="flex items-center text-slate-600">
                            <span class="w-2 h-2 rounded-full bg-green-500 mr-3"></span> DB Online
                        </li>
                        <li class="flex items-center text-slate-600">
                            <span class="w-2 h-2 rounded-full bg-green-500 mr-3"></span> Roles Activos
                        </li>
                        <li class="flex items-center text-slate-400 italic">
                            <span class="w-2 h-2 rounded-full bg-slate-300 mr-3"></span> Backup v1.02
                        </li>
                    </ul>
                </div>
            @endif

        </div>

    </div>
</div>
@endsection