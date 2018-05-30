<h1 style="text-align: center;">CONTRATO DE TRABAJO A TIEMPO INDETERMINADO</h1>

<h2 style="text-align: center;">IDENTIFICACIÓN DE LAS PARTES</h2>

<p>
  Entre la sociedad mercantil Alas de Venezuela C.A. inscrita en el Registro Mercantil II de la circunscripción judicial del Distrito Capital quedando asentada bajo el N°: 0001345 del libro: 127604 de la fecha de 05 de Octubre de 2016, domiciliada en la Ciudad de Caracas, Ubicada en Los chaguaramos Edif. Avca, representada por su Presidente Pedro Pérez, Venezolano, soltero, mayor de edad, domiciliado en la ciudad de Caracas y titular de la Cedula de Identidad N° V- 5.880.005, quien a los efectos de este documento se denominará EL PATRONO, por su parte, y el ciudadano (a): <strong>{{ $empleado->nombre }} {{ $empleado->apellido }}</strong>, <strong>{{ $empleado->nacionalidad == 'v' ? 'venezolan@' : 'extranjer@' }}</strong>, <strong>{{ $empleado->estado_civil }}</strong>, mayor de edad, domiciliado(a) en: <strong>{{ $empleado->direccion }}</strong>, <strong>{{ $empleado->ciudad }}</strong> y titular de la Cedula de Identidad <strong>N° V- {{ $empleado->cedula }}</strong>, quien en lo sucesivo se denomina EL TRABAJADOR, se ha convenido en celebrar un (01) CONTRATO DE TRABAJO A TIEMPO INDETERMINADO, de conformidad con lo establecido en los artículos 58,59 y 61 de la Ley Orgánica del Trabajo, los trabajadores y trabajadoras que en lo sucesivo se señalará como LOTT, y el cual se regirá por las siguientes clausulas:
</p>

<h2 style="text-align: center;">IDENTIFICACION DEL CARGO</h2>
{!! $empleado->obtenerCargo()['funciones'] !!}

<h2 style="text-align: center; font-weight: bold;">FECHA DE INGRESO, LUGAR DE TRABAJO</h2>

<p>
  <b>SEGUNDA: EL TRABAJADOR</b> prestará sus servicios a <b>EL PATRONO por tiempo indeterminado de conformidad con lo establecido en el art. 61 de la LOTT</b> en la sede de la empresa <b>{{ $empleado->obtenerSucursal()['nombre'] }}</b>  desde el <b>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $empleado->fecha_ingreso)->format('d/m/Y') }}</b>, desempeñando el cargo de <b>{{ $empleado->obtenerCargo()['titulo'] }}</b>.
</p>

<h2 style="text-align: center; font-weight: bold;">FORMATO, MONTO, FECHA DE PAGO Y BENEFICIOS</h2>

<p>
  TERCERA: EL TRABAJADOR devengara un salario mensual de <b>{{ $empleado->obtenerTabulador()['sueldo_base'] }} (Bs.)</b>, es decir el salario estipulado para el cargo por la empresa, siendo pagado en dos quincenas, en el horario de trabajo y en la sede principal del patrono. En caso que el día de pago coincida con un día no laborable se realizará el día hábil inmediatamente anterior. Adicionalmente un bono alimenticio de conformidad con la Ley de Alimentación para los trabajadores y trabajadoras, por día laborado por un equivalente de 0,25 UT por jornadas efectivamente laborada, la cual será cancelada a fin de mes, conjunto con la última quincena en efectivo. <br>
  Asimismo, el trabajador al momento de la culminación del contrato, le serán cancelados los siguientes conceptos: Antigüedad, Vacaciones, Bono Vacacional y Utilidades, todo de conformidad a lo establecido por la LOOT.
</p>

<p>En la Ciudad de Caracas, {{ date('d/m/Y') }}.</p>
