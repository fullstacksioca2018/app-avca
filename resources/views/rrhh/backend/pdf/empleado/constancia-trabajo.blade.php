<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Constancia de trabajo</title>
  <!-- <img  <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
</head>
<body>
       <!-- <img src="{{ asset('img/favicon.png') }}" style="float:center; width:120px;height:110px;" class="img-fluid">-->
        <br>
        <h2 style="text-align: center;">ALAS DE VENEZUELA C.A.</h2>  <br><br><br>
        <h3 style="text-align: center;">CONSTANCIA DE TRABAJO</h3>
        <br>
        <p style="text-align: justify;">
            Por medio de la presente se hace constar que <strong>{{ $empleado->nombre }} {{ $empleado->apellido }}</strong>, titular de la Cédula de Identidad <strong>N° V- {{ $empleado->cedula }}</strong>, presta sus servicios en esta empresa desde el <b>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $empleado->fecha_ingreso)->format('d/m/Y') }}</b>. Actualmente desempeña el cargo de <b>{{ $empleado->obtenerCargo()['titulo'] }}</b>, en condición laboral <b>{{ $empleado->condicion_laboral }}</b> y horario <b>{{ $empleado->tipo_horario }}</b>, adscrito a la sucursal <b>{{ $empleado->obtenerSucursal()['nombre'] }}</b>, con una remuneración mensual de <b>{{ $empleado->obtenerTabulador()['sueldo_base'] }} (Bs.)</b>.
        </p><br>
        
        <p>Constancia que se expide a solicitud de parte interesada, en Caracas a la fecha del {{ date('d/m/Y') }}.</p>
        <br><br>
        <h4 style="text-align: center;"><i>Dr. Pepito Pérez</h4>
        <p style="text-align: center">Gerente del Departamento de Recursos Humanos</p>    
</body>
</html>
