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
                @if(Auth::user()->hasRole('Maestro')) Mis Clases @endif
                @if(Auth::user()->hasRole('Alumno/Tutor')) Bienvenid@ @endif
            </h1>
            <p class="text-slate-500">
                Hola, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span>. 
                Sesión iniciada como <span class="px-2 py-0.5 rounded text-xs font-bold bg-slate-200 text-slate-700">{{ Auth::user()->rol->nombre_rol }}</span>
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
                    <p class="text-2xl font-bold text-slate-800">{{ $totalAlumnos ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center transition-all hover:shadow-md">
                <div class="p-3 rounded-lg bg-indigo-50 text-indigo-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Docentes</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalMaestros ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center transition-all hover:shadow-md">
                <div class="p-3 rounded-lg bg-teal-50 text-teal-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Materias</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalMaterias ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center transition-all hover:shadow-md">
                <div class="p-3 rounded-lg bg-purple-50 text-purple-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Grados</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalGrados ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center transition-all hover:shadow-md">
                <div class="p-3 rounded-lg bg-orange-50 text-orange-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Usuarios</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalUsuarios ?? 0 }}</p>
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
                        <a href="{{ route('alumnos.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition-all cursor-pointer">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-blue-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            </div>
                            <span class="text-sm font-medium text-slate-600 group-hover:text-blue-700 text-center">Alumnos</span>
                        </a>

                        <a href="{{ route('maestros.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-indigo-50 hover:border-indigo-200 transition-all cursor-pointer">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-indigo-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-sm font-medium text-slate-600 group-hover:text-indigo-700 text-center">Docentes</span>
                        </a>

                        <a href="{{ route('materias.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-teal-50 hover:border-teal-200 transition-all cursor-pointer">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-teal-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <span class="text-sm font-medium text-slate-600 group-hover:text-teal-700 text-center">Materias</span>
                        </a>
                        
                        <a href="{{ route('grados.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-purple-50 hover:border-purple-200 transition-all cursor-pointer">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-purple-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </div>
                            <span class="text-sm font-medium text-slate-600 group-hover:text-purple-700 text-center">Grados</span>
                        </a>

                        <a href="{{ route('users.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-orange-50 hover:border-orange-200 transition-all cursor-pointer">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-orange-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <span class="text-sm font-medium text-slate-600 group-hover:text-orange-700 text-center">Usuarios</span>
                        </a>

                        <a href="{{ route('roles.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-gray-50 hover:border-gray-200 transition-all cursor-pointer">
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
                                    <th class="px-6 py-3">Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-3 font-medium text-slate-900">Juan Pérez</td>
                                    <td class="px-6 py-3">9no A</td>
                                    <td class="px-6 py-3"><span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Activo</span></td>
                                    <td class="px-6 py-3 text-slate-400">Hoy</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if(Auth::user()->hasRole('Maestro'))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 border-l-4 border-indigo-500 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-slate-800">Gestionar Calificaciones</h3>
                            <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                        </div>
                        <p class="text-slate-500 text-sm mb-6">Accede a tus grupos asignados, captura calificaciones y revisa el historial académico.</p>
                        <a href="#" class="inline-flex items-center justify-center w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition-colors">
                            Ir a Calificaciones &rarr;
                        </a>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-800 mb-2">Avisos Docentes</h3>
                        <div class="space-y-3">
                            <div class="p-3 bg-yellow-50 rounded-lg border border-yellow-100 text-sm text-yellow-800">
                                <strong>Recordatorio:</strong> La captura de calificaciones del Parcial 1 cierra el viernes.
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(Auth::user()->hasRole('Alumno/Tutor'))
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 text-blue-600 rounded-full mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">¡Bienvenido a tu Portal Escolar!</h3>
                    <p class="text-slate-500 max-w-md mx-auto mb-6">
                        Aquí podrás consultar tus calificaciones, horarios y avisos importantes. Estamos trabajando para mejorar tu experiencia.
                    </p>
                    <div class="flex justify-center gap-4">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Ver Mis Notas</button>
                        <button class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition">Mi Horario</button>
                    </div>
                </div>
            @endif

        </div>

        <div class="space-y-6">
            
            <div class="bg-blue-600 rounded-xl shadow-lg p-6 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-lg font-bold mb-2">Próxima Evaluación</h3>
                    <p class="text-blue-100 text-sm mb-4">El periodo de evaluación del 2do Parcial cierra pronto.</p>
                    <button class="bg-white text-blue-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-50 transition">Ver Calendario</button>
                </div>
                <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-blue-500 rounded-full opacity-50"></div>
                <div class="absolute -top-4 -right-4 w-16 h-16 bg-blue-400 rounded-full opacity-30"></div>
            </div>

            @if(Auth::user()->hasRole('Administrador'))
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-bold text-slate-800 mb-4">Estado del Sistema</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center text-slate-600">
                            <span class="w-2 h-2 rounded-full bg-green-500 mr-3"></span>
                            Base de Datos Conectada
                        </li>
                        <li class="flex items-center text-slate-600">
                            <span class="w-2 h-2 rounded-full bg-green-500 mr-3"></span>
                            Servicios Activos
                        </li>
                        <li class="flex items-center text-slate-600">
                            <span class="w-2 h-2 rounded-full bg-slate-300 mr-3"></span>
                            Respaldo Automático (Pendiente)
                        </li>
                    </ul>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection