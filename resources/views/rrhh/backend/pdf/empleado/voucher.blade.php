<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voucher</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    @php($asignaciones = 0)
    @php($deducciones = 0)
    <table class="table table-striped">
        <thead class="bg-dark text-white">
        <tr>
            <th>Código</th>
            <th>Concepto</th>
            <th>% Monto</th>
            <th>Asignaciones</th>
            <th>Deducciones</th>
            <th>--</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($vouchers as $voucher)
            <tr>
                <td>{{ $voucher->conceptosPorEmpleado()->tipo_concepto }}</td>
                <td>{{ $voucher->conceptosPorEmpleado()->descripcion }}</td>
                <td>{{ $voucher->conceptosPorEmpleado()->porcentaje }}</td>
                <td>
                    @if(!starts_with($voucher->conceptosPorEmpleado()->tipo_concepto, '5'))
                        {{ $voucher->monto }}
                        @php($asignaciones = $asignaciones + (float)$voucher->monto)
                    @endif
                </td>
                <td>
                    @if(starts_with($voucher->conceptosPorEmpleado()->tipo_concepto, '5'))
                        {{ $voucher->monto }}
                        @php($deducciones = $deducciones + (float)$voucher->monto)
                    @endif
                </td>
                <td></td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td><strong>Total</strong></td>
            <td><strong>{{ number_format($asignaciones, 2) }}</strong></td>
            <td><strong>{{ number_format($deducciones, 2) }}</strong></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Total a pagar</strong></td>
            <td><strong>{{ number_format($asignaciones - $deducciones, 2) }}</strong></td>
        </tr>
        </tbody>
    </table>
</body>
</html>
