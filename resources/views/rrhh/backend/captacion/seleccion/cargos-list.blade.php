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
          <li class="breadcrumb-item"><a href="{{ route('aspirantes.areas') }}">Áreas</a></li>
          <li class="breadcrumb-item active">Cargos</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
  <div class="container">
    <div class="row aspirantes">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-info-gradient">Listado de cargos vacantes</div>
          <div class="card-body">
            <table class="table table-striped">
              <thead>
              <tr>
                <th>Cargo</th>
                <th>&nbsp;</th>
              </tr>
              </thead>
              <tbody>
              @foreach($cargos as $cargo)
                <tr>
                  <td>{{ $cargo->titulo }}</td>
                  <td width="10%">
                    <a href="{{ route('aspirantes.list', [$area_id, $vacante_id]) }}" class="btn btn-info btn-sm">
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
    </div>
  </div>
@endsection
