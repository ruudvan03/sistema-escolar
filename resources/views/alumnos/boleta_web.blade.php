@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Consulta de Boleta</h2>
        <a href="{{ route('alumnos.descargar_boleta', $alumno->id_alumno) }}" class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Descargar Boleta en PDF
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>Datos del Alumno: {{ $alumno->nombre }} {{ $alumno->apellido_p }}</h5>
            <p>Matrícula: {{ $alumno->matricula }}</p>
            
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Materia</th>
                        <th>Calificación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumno->calificaciones as $cal)
                    <tr>
                        <td>{{ $cal->materia->nombre }}</td>
                        <td>{{ $cal->calificacion }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection