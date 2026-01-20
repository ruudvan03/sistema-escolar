@extends('layouts.app')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Panel de Control</h1>
            <p class="text-slate-500">Bienvenido de nuevo, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span></p>
        </div>
        <div class="flex gap-2">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700 border border-blue-100">
                <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                Ciclo Escolar 2026-A
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center transition-all hover:shadow-md">
            <div class="p-3 rounded-lg bg-blue-50 text-blue-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Alumnos</p>
                <p class="text-2xl font-bold text-slate-800">{{ $totalAlumnos ?? 0 }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center transition-all hover:shadow-md">
            <div class="p-3 rounded-lg bg-indigo-50 text-indigo-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Docentes</p>
                <p class="text-2xl font-bold text-slate-800">{{ $totalMaestros ?? 0 }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center transition-all hover:shadow-md">
            <div class="p-3 rounded-lg bg-teal-50 text-teal-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Materias</p>
                <p class="text-2xl font-bold text-slate-800">{{ $totalMaterias ?? 0 }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center transition-all hover:shadow-md">
            <div class="p-3 rounded-lg bg-orange-50 text-orange-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Usuarios</p>
                <p class="text-2xl font-bold text-slate-800">{{ $totalUsuarios ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Gestión Académica</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    
                    <a href="{{ route('roles.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition-all cursor-pointer">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-blue-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-slate-600 group-hover:text-blue-700">Roles</span>
                    </a>

                    <a href="{{ route('permisos.index') }}" class="group flex flex-col items-center p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition-all cursor-pointer">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-blue-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11.536 16.536m-1.743 0l-.134.135a.69.69 0 01-.979 0l-.606-.607a.69.69 0 010-.979l.135-.134m-3.414 1.414l-2.008 2.009a2 2 0 01-2.828 0l-.707-.707a2 2 0 010-2.828l2.009-2.008m-1.414-3.414l.879-.879a.69.69 0 01.979 0l.607.607a.69.69 0 010 .979l-.879.879m5.657-5.657a6 6 0 118 4.85z"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-slate-600 group-hover:text-blue-700">Permisos</span>
                    </a>

                    <div class="group flex flex-col items-center p-4 rounded-xl border border-dashed border-slate-200 bg-white opacity-60 cursor-not-allowed">
                        <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shadow-sm mb-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-slate-400">Nuevo Módulo</span>
                    </div>

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
                            {{-- Ejemplo de datos estáticos --}}
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-3 font-medium text-slate-900">Juan Pérez</td>
                                <td class="px-6 py-3">9no A</td>
                                <td class="px-6 py-3"><span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Activo</span></td>
                                <td class="px-6 py-3 text-slate-400">Hoy</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-3 font-medium text-slate-900">Ana García</td>
                                <td class="px-6 py-3">1ro B</td>
                                <td class="px-6 py-3"><span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Pendiente</span></td>
                                <td class="px-6 py-3 text-slate-400">Ayer</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="font-bold text-slate-800 mb-4">Sistema</h3>
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
        </div>

    </div>
</div>
@endsection