@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Gestión de Permisos por Rol</h2>

    <form method="POST" action="{{ route('permisos.store') }}">
        @csrf

        @foreach ($roles as $rol)
            <h4 class="mt-4">
                Rol: <strong>{{ $rol->nombre_rol }}</strong>
            </h4>

            <table border="1" cellpadding="8" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Módulo</th>
                        <th>Mostrar</th>
                        <th>Crear</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($modulos as $modulo)
                        <tr>
                            <td>{{ $modulo->nombre_modulo }}</td>

                            @foreach (['mostrar','crear','actualizar','eliminar'] as $accion)
                                <td align="center">
                                    <input
                                        type="checkbox"
                                        name="permisos[{{ $rol->id_rol }}][{{ $modulo->id_modulo }}][{{ $accion }}]"
                                    >
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

        <br>
        <button type="submit">Guardar permisos</button>
    </form>

</div>
@endsection
