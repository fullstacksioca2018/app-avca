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
                            <th>Hora entrada</th>
                        </tr>
                    </thead>
                    <tbody>                    
                        @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->nombre_grupo }}</td>
                            <td>{{ $empleado->cedula }}</td>
                            <td>{{ $empleado->nombre }} {{ $empleado->apellido }}</td>
                            <td>{{ $empleado->titulo_cargo }}</td>
                            <td>{{ $empleado->h_entrada }}</td>
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
