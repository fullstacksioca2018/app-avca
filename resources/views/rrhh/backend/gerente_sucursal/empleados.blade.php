@extends('rrhh.layouts.backend')

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

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info-gradient">Empleados de la sucursal: <b>{{ $sucursal->nombre }}</b></div>
            <div class="card-body">
                <table class="table table-striped table-hover" id="listadoEmpleados">
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Cédula</th>
                            <th>Nombre y Apellido</th>                            
                            <th>Cargo</th>
                            <th class="text-center">Incidencias</th>
                        </tr>
                    </thead>
                    <tbody>                    
                        @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->grupo->nombre }}</td>
                            <td>{{ $empleado->cedula }}</td>
                            <td>{{ $empleado->fullname }}</td>                            
                            <td>{{ $empleado->obtenerCargo()->titulo }}</td>
                            <td class="text-center">                                
                                <a href="{{ route('dashboard.empleado', ['empleado' => $empleado->empleado_id]) }}" class="btn btn-info">
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
