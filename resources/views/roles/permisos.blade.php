@extends('layouts.app')

@section('content')
<div class="container">

    <h3>
        Gestión de Permisos para el Rol:
        <span class="badge bg-primary">{{ $rol->nombre }}</span>
    </h3>

    <form method="POST" action="{{ route('roles.permisos.update', $rol->id_rol) }}">
        @csrf

        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Módulo</th>
                    <th>Mostrar</th>
                    <th>Crear</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modulos as $modulo)
                @php
                    $p = $permisos[$modulo->id_modulo] ?? null;
                @endphp
                <tr>
                    <td>{{ $modulo->nombre }}</td>

                    @foreach(['mostrar','crear','actualizar','eliminar'] as $accion)
                    <td class="text-center">
                        <input type="checkbox"
                               name="permisos[{{ $modulo->id_modulo }}][{{ $accion }}]"
                               {{ $p && $p->$accion ? 'checked' : '' }}>
                    </td>
                    @endforeach

                </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn btn-success">
            Guardar Permisos
        </button>

        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
            Volver
        </a>

    </form>
</div>
@endsection
