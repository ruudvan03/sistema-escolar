@extends('layouts.guest')

@section('content')
<a href="{{ route('landing') }}" class="absolute top-6 left-6 flex items-center text-slate-500 hover:text-blue-600 transition-all group">
    <div class="p-2 rounded-full bg-white shadow-sm border border-slate-200 group-hover:border-blue-200 group-hover:scale-105 transition-transform">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </div>
    <span class="ml-2 font-medium text-sm opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all duration-300">Volver al Inicio</span>
</a>

<div class="min-h-screen flex items-center justify-center bg-slate-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-2xl border border-slate-200 relative">
        
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-blue-600 rounded-full flex items-center justify-center mb-4 shadow-lg shadow-blue-500/50">
                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                </svg>
            </div>
            <h2 class="mt-6 text-3xl font-extrabold text-slate-900">Bienvenido</h2>
            <p class="mt-2 text-sm text-slate-600">Ingresa tus credenciales para acceder</p>
        </div>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Correo Electrónico</label>
                    <input id="email" name="email" type="email" required autocomplete="email" autofocus
                        class="appearance-none relative block w-full px-4 py-3 border border-slate-300 placeholder-slate-400 text-slate-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all" 
                        placeholder="admin@escuela.edu"
                        value="{{ old('email') }}">
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Contraseña</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="appearance-none relative block w-full px-4 py-3 border border-slate-300 placeholder-slate-400 text-slate-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all" 
                        placeholder="••••••••">
                    @error('password')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded cursor-pointer" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="ml-2 block text-sm text-slate-600 cursor-pointer select-none">Recordarme</label>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                @endif
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400 transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>
    
    <div class="absolute bottom-4 text-center text-xs text-slate-400">
        &copy; {{ date('Y') }} Sistema Escolar. Todos los derechos reservados.
    </div>
</div>
@endsection