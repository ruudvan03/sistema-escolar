<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta de Calificaciones - {{ $alumno->matricula }}</title>
    <style>
        @page { margin: 1cm; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #334155; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #0f172a; padding-bottom: 10px; }
        .school-name { font-size: 18px; font-weight: bold; color: #0f172a; margin: 0; text-transform: uppercase; }
        .info-section { margin-bottom: 20px; width: 100%; }
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table td { padding: 4px 0; font-size: 12px; }
        .label { font-weight: bold; text-transform: uppercase; color: #64748b; width: 100px; }
        
        table.data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.data-table th { background-color: #f1f5f9; color: #475569; font-size: 10px; font-weight: bold; text-transform: uppercase; border: 1px solid #e2e8f0; padding: 10px; }
        table.data-table td { border: 1px solid #e2e8f0; padding: 10px; font-size: 11px; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .bg-gray { background-color: #f8fafc; }
        
        .footer { margin-top: 40px; text-align: center; font-size: 10px; color: #94a3b8; }
        .promedio-badge { font-weight: bold; padding: 4px 8px; border-radius: 4px; }
        .aprobado { color: #059669; }
        .reprobado { color: #dc2626; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="school-name">Sistema Escolar Preparatoria</h1>
        <p style="margin: 5px 0; font-weight: bold;">BOLETA OFICIAL DE CALIFICACIONES</p>
    </div>

    <div class="info-section">
        <table class="info-table">
            <tr>
                <td class="label">Alumno:</td>
                <td class="font-bold">{{ $alumno->nombre }} {{ $alumno->apellido_p }} {{ $alumno->apellido_m }}</td>
                <td class="label">Matrícula:</td>
                <td class="font-bold">{{ $alumno->matricula }}</td>
            </tr>
            <tr>
                <td class="label">Ciclo:</td>
                <td>{{ $inscripciones->first()->ciclo_escolar ?? '2026-A' }}</td>
                <td class="label">Fecha:</td>
                <td>{{ date('d/m/Y H:i') }}</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="text-align: left;">Asignatura</th>
                <th class="text-center">Parcial 1</th>
                <th class="text-center">Parcial 2</th>
                <th class="text-center">Parcial 3</th>
                <th class="text-center">Promedio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inscripciones as $inscripcion)
                @foreach($inscripcion->asignacionesDelGrupo as $asig)
                    @php
                        $n1 = $inscripcion->calificaciones->where('id_asignacion', $asig->id_asignacion)->where('id_parcial', 1)->first()->calificacion ?? 0;
                        $n2 = $inscripcion->calificaciones->where('id_asignacion', $asig->id_asignacion)->where('id_parcial', 2)->first()->calificacion ?? 0;
                        $n3 = $inscripcion->calificaciones->where('id_asignacion', $asig->id_asignacion)->where('id_parcial', 3)->first()->calificacion ?? 0;
                        $prom = ($n1 + $n2 + $n3) / 3;
                    @endphp
                    <tr>
                        <td class="font-bold">{{ $asig->materia->nombre_materia }}</td>
                        <td class="text-center">{{ $n1 ?: '0.0' }}</td>
                        <td class="text-center">{{ $n2 ?: '0.0' }}</td>
                        <td class="text-center">{{ $n3 ?: '0.0' }}</td>
                        <td class="text-center font-bold bg-gray {{ $prom < 6 ? 'reprobado' : 'aprobado' }}">
                            {{ number_format($prom, 1) }}
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Este documento es una constancia digital de carácter informativo.</p>
        <p>Generado automáticamente por el Sistema de Control Escolar.</p>
    </div>
</body>
</html>