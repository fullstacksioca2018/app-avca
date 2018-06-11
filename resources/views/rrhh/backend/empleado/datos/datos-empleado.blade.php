@push('styles')
    <style>
        .empleado-img {
            max-width: 15%;
        }
        .empleado-item {
            display: flex;
            align-items: baseline;
            font-size: 16px;
        }
        .empleado-item h5 {
            color: #17a2b8;
            font-size: 16px;
            font-weight: 600;
            margin: 0;
            padding: 0;
        }
        .disabled {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
            opacity: 0.65;
        }
    </style>
@endpush
<div class="media">
    @if($empleado->foto !== '')
    <img class="mr-3 empleado-img img-thumbnail" src="{{ '/storage/empleados/' . $empleado->cedula .'/foto/' . $empleado->foto }}" alt="{{ $empleado->nombre }}">
    @else
    <img class="mr-3 empleado-img img-thumbnail" src="/img/rrhh/businessman.png" alt="{{ $empleado->nombre }}">
    @endif
    <div class="media-body">
        <div class="row empleado">
            <div class="col-md-6 empleado-item">
                <h5>Nombre: </h5>
                <span class="ml-2">{{ $empleado->nombre }} {{ $empleado->apellido }}</span>
            </div>
            <div class="col-md-3 empleado-item">
                <h5>Cédula: </h5>
                <span class="ml-2">{{ $empleado->cedula }}</span>
            </div>
            <div class="col-md-3 empleado-item">
                <h5>Fecha ingreso: </h5>
                <span class="ml-2">{{ Carbon\Carbon::createFromFormat('Y-m-d', $empleado->fecha_ingreso)->format('d/m/Y') }}</span>
            </div>
        </div>
        <div class="row empleado my-3">
            <div class="col-md-6 empleado-item">
                <h5>Sucursal: </h5>
                <span class="ml-2">{{ $empleado->nombre_sucursal }}</span>
            </div>
            <div class="col-md-6 empleado-item">
                <h5>Departamento: </h5>
                <span class="ml-2">{{ $empleado->descripcion }}</span>
            </div>
        </div>
        <div class="row empleado">
            <div class="col-md-6 empleado-item">
                <h5>Cargo: </h5>
                <span class="ml-2">{{ $empleado->nombre_cargo }}</span>
            </div>
            <div class="col-md-6 empleado-item">
                <h5>Condición laboral: </h5>
                <span class="ml-2">{{ $empleado->condicion_laboral }}</span>
            </div>
        </div>
    </div>
</div>