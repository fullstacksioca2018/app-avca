@extends('rrhh.layouts.backend')

@section('breadcrumb')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Selección de aspirantes</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('aspirantes.areas') }}">Cargos</a></li>
          <li class="breadcrumb-item active">Aspirantes</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
  <div class="col-12">
    {{--Filtrado de aspirantes por estatus--}}    
    <aspirante-status :vacante="{{ $vacante }}" estatus="{{ $estatus }}"></aspirante-status>
    <hr>    
    {{--Listado de aspirantes--}}    
    <aspirante-table :vacante="{{ $vacante }}" :aspirantes="{{ $aspirantes }}"></aspirante-table>
    
    {{--  @include('rrhh.backend.captacion.seleccion.partials.aspirantes-filter', [$vacante, $estatus])
    <div class="card">
      <div class="card-header bg-info-gradient">Listado de aspirantes</div>
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead>
          <tr>
            <th>Cédula</th>
            <th>F. Nacimiento</th>
            <th>Nombre y Apellido</th>
            <th>Correo electrónico</th>
            @switch($estatus)
              @case('registrados')
                <th>Curriculum</th>
                @break
              @case('verificados')
                <th>Requisitos</th>
                @break
            @endswitch
            @if($estatus == 'registrados')
            <th>&nbsp;</th>
            @endif
          </tr>
          </thead>
          <tbody>
          @foreach($aspirantes as $aspirante)
            <tr>
              <td>{{ $aspirante->cedula }}</td>
              <td>{{ $aspirante->fechaFormateada }}</td>
              <td>{{ $aspirante->fullName }}</td>
              <td>{{ $aspirante->email }}</td>
              <td>
              @switch($estatus)
                @case('registrados')
                  <a href="#" class="btn btn-info btn-sm">
                    <i class="fa fa-pdf"></i> Curriculum
                  </a>
                @break
                @case('verificados')
                  <a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#aspiranteVerificadoModal">
                    <i class="fa fa-envelope-o"></i> Enviar requisitos
                  </a>
                @break
              @endswitch
              </td>

              {{--Columna que se va a mostrar unicamente cuando el estatus sea el de registrados--}}
              {{--  @if($estatus == 'registrados')
              <td>
                <a href="{{ route('aspirantes.cambiar-estatus', [$aspirante->aspirante_id, $vacante, $estatus = 'verificados']) }}" class="btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Verificar">
                  <i class="fa fa-check"></i>
                </a>
              </td>
              @endif
            </tr>
          @endforeach
          </tbody>
        </table>
        {{ $aspirantes->render() }}
      </div>  
    </div> --}}

    {{--Modal de aspirante verificado--}}
    {{--  @include('rrhh.backend.captacion.seleccion.modals.aspirantes-verificados-modal')  --}}
  </div>
@endsection
