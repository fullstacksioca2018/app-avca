@extends('rrhh.layouts.backend')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/rrhh/dataTables.bootstrap4.min.css') }}">
@endpush

@section('breadcrumb')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Listado de empleados</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item active">Contrato del Empleado</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
  
  <div class="col-12">
    <div class="card">
        <div class="card-header bg-info-gradient">Contrato laboral</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="listadoEmpleados">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre y Apellido</th>
                        <th>Profesión</th>
                        <th>Fecha de ingreso</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->cedula }}</td>
                        <td>{{ $empleado->nombre }} {{ $empleado->apellido }}</td>
                        <td>{{ $empleado->obtenerProfesion()['titulo'] }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $empleado->fecha_ingreso)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('pdf.contract', $empleado->empleado_id) }}" class="btn btn-sm btn-light">
                                <i class="fa fa-file-pdf-o mr-2" style="color: crimson;"></i> Ver contrato
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
