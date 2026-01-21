@extends('layouts.app')

@section('header')
    Editar Usuario
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
        
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-800">Editar Usuario</h2>
            <p class="text-slate-500">Actualiza la información de <span class="font-bold text-blue-600">{{ $user->name }}</span>.</p>
        </div>

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nombre Completo</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required 
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Correo Electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required 
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="id_rol" class="block text-sm font-medium text-slate-700 mb-1">Asignar Rol</label>
                <select name="id_rol" id="id_rol" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition bg-white">
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id_rol }}" {{ (old('id_rol', $user->id_rol) == $rol->id_rol) ? 'selected' : '' }}>
                            {{ $rol->nombre_rol }}
                        </option>
                    @endforeach
                </select>
                @error('id_rol') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="border-t border-slate-100 pt-6 mt-6">
                <h3 class="text-sm font-bold text-slate-900 mb-4">Cambiar Contraseña (Opcional)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Nueva Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="Dejar en blanco para mantener"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar solo si cambiaste"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('users.index') }}" class="text-slate-500 hover:text-slate-700 font-medium">Cancelar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-bold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all">
                    Actualizar Usuario
                </button>
            </div>

        </form>
    </div>
</div>
@endsection