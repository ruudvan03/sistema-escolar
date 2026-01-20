@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Dashboard</h1>
    <p>Bienvenido al sistema escolar</p>

    <hr>

    <div style="display: flex; gap: 20px;">

        <div style="border: 1px solid #ccc; padding: 20px; width: 200px;">
            <h3>Permisos</h3>
            <p>Gestiona los permisos por rol</p>
            <a href="{{ route('permisos.index') }}">
                Ir a Permisos
            </a>
        </div>

        <div style="border: 1px solid #ccc; padding: 20px; width: 200px;">
            <h3>Usuarios</h3>
            <p>Administración de usuarios</p>
            <span style="color: gray;">(Próximamente)</span>
        </div>

        <div style="border: 1px solid #ccc; padding: 20px; width: 200px;">
            <h3>Módulos</h3>
            <p>Gestión del sistema</p>
            <span style="color: gray;">(Próximamente)</span>
        </div>

    </div>

</div>
@endsection
