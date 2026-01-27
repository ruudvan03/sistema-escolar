<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema Escolar') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .sidebar-transition { transition: width 0.3s ease-in-out, transform 0.3s ease-in-out; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased">
    
    <div id="app" class="min-h-screen flex">

        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 bg-slate-900 text-white transform -translate-x-full md:translate-x-0 md:relative sidebar-transition shadow-2xl flex flex-col w-64 group">
            
            <div class="h-16 flex items-center justify-center border-b border-slate-800 bg-slate-950 flex-shrink-0 overflow-hidden">
                <a href="{{ url('/') }}" class="flex items-center gap-2 font-bold text-xl tracking-wider text-white whitespace-nowrap">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <span class="sidebar-text duration-300">Escuela<span class="text-blue-500">App</span></span>
                </a>
            </div>

            <nav class="flex-1 p-4 space-y-2 overflow-y-auto overflow-x-hidden no-scrollbar">
                
                <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-2 sidebar-header whitespace-nowrap transition-opacity duration-300">
                    Principal
                </p>
                
                <a href="{{ route('dashboard') }}" class="flex items-center p-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : '' }}" title="Dashboard">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="ml-3 sidebar-text whitespace-nowrap duration-300">Dashboard</span>
                </a>

                <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6 sidebar-header whitespace-nowrap transition-opacity duration-300">
                    Académico
                </p>

                <a href="{{ route('maestros.index') }}" class="flex items-center p-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('maestros.*') ? 'bg-slate-800 text-white border-l-4 border-indigo-500' : '' }}" title="Gestión de Docentes">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    <span class="ml-3 sidebar-text whitespace-nowrap duration-300">Docentes</span>
                </a>

                <a href="{{ route('alumnos.index') }}" class="flex items-center p-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('alumnos.*') ? 'bg-slate-800 text-white border-l-4 border-blue-500' : '' }}" title="Gestión de Alumnos">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                    <span class="ml-3 sidebar-text whitespace-nowrap duration-300">Alumnos</span>
                </a>
                
                <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6 sidebar-header whitespace-nowrap transition-opacity duration-300">
                    Administración
                </p>

                <a href="{{ route('users.index') }}" class="flex items-center p-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('users.*') ? 'bg-slate-800 text-white border-l-4 border-blue-500' : '' }}" title="Gestión de Usuarios">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="ml-3 sidebar-text whitespace-nowrap duration-300">Usuarios</span>
                </a>

                <a href="{{ route('roles.index') }}" class="flex items-center p-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('roles.*') ? 'bg-slate-800 text-white border-l-4 border-blue-500' : '' }}" title="Roles y Permisos">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    <span class="ml-3 sidebar-text whitespace-nowrap duration-300">Roles y Permisos</span>
                </a>

                <a href="#" class="flex items-center p-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors" title="Configuración">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="ml-3 sidebar-text whitespace-nowrap duration-300">Configuración</span>
                </a>

            </nav>

            <div class="hidden md:flex justify-center p-4 border-t border-slate-800">
                <button id="desktopToggle" class="p-2 rounded-lg bg-slate-800 hover:bg-blue-600 transition-colors text-slate-400 hover:text-white focus:outline-none">
                    <svg id="toggleIcon" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                    </svg>
                </button>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-h-screen transition-all duration-300">
            <header class="bg-white shadow-sm border-b border-slate-200 h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8 z-40 sticky top-0">
                <button id="sidebarToggle" class="md:hidden text-slate-500 hover:text-slate-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="flex-1 px-4 hidden md:block">
                    <h2 class="font-semibold text-lg text-slate-800">
                        @yield('header', 'Panel de Administración')
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <button class="text-slate-400 hover:text-blue-600 relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                    </button>
                    
                    <div class="border-l border-slate-200 h-6 mx-2"></div>
                    
                    <div class="relative"> 
                        @guest
                            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600">Login</a>
                        @else
                            <button id="userMenuBtn" class="flex items-center gap-2 text-sm font-medium text-slate-700 hover:text-blue-600 focus:outline-none transition-colors">
                                <span>{{ Auth::user()->name }}</span>
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold border border-blue-200">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <svg id="userMenuIcon" class="w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <div id="userMenuDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-slate-100 py-1 z-50 animate-fade-in-down origin-top-right">
                                <div class="px-4 py-2 border-b border-slate-100">
                                    <p class="text-xs text-slate-400">Sesión iniciada</p>
                                    <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition-colors">
                                    Mi Perfil
                                </a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        @endguest
                    </div>
                </div>
            </header>

            <main class="flex-grow p-6 overflow-y-auto">
                <div class="max-w-7xl mx-auto w-full">
                    @yield('content')
                </div>
            </main>

            <footer class="bg-white border-t border-slate-200 py-4 px-6 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} Sistema Escolar v1.0
            </footer>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mobileBtn = document.getElementById('sidebarToggle');
        const desktopBtn = document.getElementById('desktopToggle');
        const toggleIcon = document.getElementById('toggleIcon');
        const texts = document.querySelectorAll('.sidebar-text');
        const headers = document.querySelectorAll('.sidebar-header');

        // Variables menú usuario
        const userMenuBtn = document.getElementById('userMenuBtn');
        const userMenuDropdown = document.getElementById('userMenuDropdown');
        const userMenuIcon = document.getElementById('userMenuIcon');

        // LÓGICA DEL SIDEBAR 
        let isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

        function updateSidebarState() {
            if (window.innerWidth >= 768) { 
                if (isCollapsed) {
                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-20');
                    toggleIcon.classList.add('rotate-180');
                    texts.forEach(t => t.classList.add('hidden'));
                    headers.forEach(h => h.classList.add('hidden'));
                } else {
                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-64');
                    toggleIcon.classList.remove('rotate-180');
                    setTimeout(() => {
                        texts.forEach(t => t.classList.remove('hidden'));
                        headers.forEach(h => h.classList.remove('hidden'));
                    }, 50);
                }
            }
        }
        updateSidebarState();

        if(desktopBtn) {
            desktopBtn.addEventListener('click', () => {
                isCollapsed = !isCollapsed;
                localStorage.setItem('sidebarCollapsed', isCollapsed);
                updateSidebarState();
            });
        }
        if(mobileBtn) {
            mobileBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        }

        // LÓGICA DEL MENÚ USUARIO 
        if (userMenuBtn) {
            userMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userMenuDropdown.classList.toggle('hidden');
                userMenuIcon.classList.toggle('rotate-180');
            });

            // Cerrar al hacer clic fuera
            document.addEventListener('click', (e) => {
                if (window.innerWidth < 768) { 
                    if (!sidebar.contains(e.target) && !mobileBtn.contains(e.target) && !sidebar.classList.contains('-translate-x-full')) {
                        sidebar.classList.add('-translate-x-full');
                    }
                }
                if (!userMenuDropdown.classList.contains('hidden')) {
                    if (!userMenuDropdown.contains(e.target) && !userMenuBtn.contains(e.target)) {
                        userMenuDropdown.classList.add('hidden');
                        userMenuIcon.classList.remove('rotate-180');
                    }
                }
            });
        }
    </script>
</body>
</html>