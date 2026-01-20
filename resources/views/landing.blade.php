<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema Escolar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand">Sistema Escolar</span>

    <a href="{{ route('login') }}" class="btn btn-outline-light">
        Iniciar sesión
    </a>
</nav>

<div class="container text-center mt-5">
    <h1>Sistema de Gestión Escolar</h1>
    <p class="mt-3">Acceso exclusivo para personal autorizado</p>

    <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-3">
        Iniciar sesión
    </a>
</div>

</body>
</html>
