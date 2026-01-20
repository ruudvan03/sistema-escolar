@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Roles del Sistema</h1>

    <ul>
        @foreach ($roles as $id => $rol)
            <li>
                {{ $rol }}
                <a href="{{ route('roles.permisos', $id) }}">
                    Configurar permisos
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
