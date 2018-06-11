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
    <h2 class="text-center">Carga familiar</h2>
    <table class="table table-striped">
        <thead class="bg-dark text-white">
        <tr>
            <th>Cédula</th>
            <th>Nombre y Apellido</th>
            <th>F. Nacimiento</th>
            <th>Sexo</th>
            <th>Parentesco</th>        
        </tr>
        </thead>
        <tbody>

        @foreach ($carga_familiar as $cf)            
        <tr>
            <td>{{ $cf->cedula_beneficiario }}</td>
            <td>{{ $cf->nombre }} {{ $cf->apellido }}</td>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $cf->fecha_nacimiento)->format('d/m/Y') }}</td>
            <td>{{ $cf->genero }}</td>
            <td>{{ $cf->parentesco }}</td>            
        </tr>
        @endforeach
        
        </tbody>
    </table>
</body>
</html>
