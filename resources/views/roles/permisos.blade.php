@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-slate-800">Configurar Permisos</h2>
            <p class="text-slate-500 mt-1">
                Rol: <span class="bg-blue-100 text-blue-700 py-1 px-3 rounded-full text-sm font-bold border border-blue-200">{{ $rol->nombre_rol }}</span>
            </p>
        </div>
        <a href="{{ route('roles.index') }}" class="flex items-center text-slate-500 hover:text-blue-600 font-medium transition-colors">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Volver a Roles
        </a>
    </div>

    <form action="{{ route('roles.permisos.update', $rol->id_rol) }}" method="POST">
        @csrf
        
        <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Módulo
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Ver
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Crear
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Editar
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Eliminar
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @foreach($modulos as $modulo)
                        @php
                            $permiso = $permisosActuales[$modulo->id_modulo] ?? null;
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-slate-900">{{ $modulo->nombre_modulo }}</div>
                                <div class="text-xs text-slate-400">Control de acceso al módulo</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center">
                                    <input type="checkbox" 
                                           name="permisos[{{ $modulo->id_modulo }}][mostrar]" 
                                           value="1"
                                           class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer shadow-sm"
                                           {{ optional($permiso)->mostrar ? 'checked' : '' }}>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center">
                                    <input type="checkbox" 
                                           name="permisos[{{ $modulo->id_modulo }}][crear]" 
                                           value="1"
                                           class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer shadow-sm"
                                           {{ optional($permiso)->crear ? 'checked' : '' }}>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center">
                                    <input type="checkbox" 
                                           name="permisos[{{ $modulo->id_modulo }}][actualizar]" 
                                           value="1"
                                           class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer shadow-sm"
                                           {{ optional($permiso)->actualizar ? 'checked' : '' }}>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center">
                                    <input type="checkbox" 
                                           name="permisos[{{ $modulo->id_modulo }}][eliminar]" 
                                           value="1"
                                           class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500 cursor-pointer shadow-sm"
                                           {{ optional($permiso)->eliminar ? 'checked' : '' }}>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-end gap-4">
            <a href="{{ route('roles.index') }}" class="px-6 py-3 border border-slate-300 rounded-lg text-slate-700 font-semibold hover:bg-slate-50 transition">
                Cancelar
            </a>
            <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection