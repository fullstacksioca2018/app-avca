@extends ('rrhh.layouts.backend')

@push('styles')
<style>
    .pagination {
        justify-content: flex-end;
    }
    #listadoEmpleados_filter {
        display: flex;
        justify-content: flex-end;
    }
    #listadoEmpleados_filter label {
        width: 100%;
    }
</style>
@endpush

@section('breadcrumb')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Analista de nómina</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Empleados</li>
                </ol>                
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info-gradient">Empleados</div>
            <div class="card-body">
                <table class="table table-striped table-hover" id="listadoEmpleados">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre y Apellido</th>
                            <th>Sucursal</th>
                            <th>Cargo</th>
                            <th>--</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->cedula }}</td>
                            <td>{{ $empleado->fullname }}</td>
                            <td>{{ $empleado->obtenerSucursal()->nombre }}</td>
                            <td>{{ $empleado->obtenerCargo()->titulo }}</td>
                            <td>
                                <a href="{{ route('dashboard.empleado', ['empleado' => $empleado->empleado_id]) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver datos de {{ $empleado->fullname }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
  @include('sweet::alert')
  <script src="{{ asset('js/rrhh/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/rrhh/dataTables.bootstrap4.min.js') }}"></script>
  <script>
    $(document).ready(function() {        
        $('#listadoEmpleados').DataTable({
            "language": {
                "url": "{{ asset('js/rrhh/Spanish.json') }}"
            }
        });
    } );
  </script>
@endpush
