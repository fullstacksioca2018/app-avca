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
          <li class="breadcrumb-item active">Vacantes</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-info-gradient">Listado de vacantes</div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Cargo</th>
            <th>Sucursal</th>
            <th>Fecha de publicación</th>
            <th>&nbsp;</th>
          </tr>
          </thead>
          <tbody>
          @foreach($vacantes as $vacante)
            <tr>
              <td>{{ $vacante->titulo }}</td>
              <td class="text-capitalize">{{ $vacante->nombre }}</td>
              <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $vacante->fecha_publicacion)->format('d/m/Y') }}</td>
              <td>
                <a href="{{ route('aspirantes.list', [$vacante->vacante_id, $estatus = 'registrados']) }}" class="btn btn-info btn-sm">
                  Ver aspirantes <i class="fa fa-angle-right"></i>
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
