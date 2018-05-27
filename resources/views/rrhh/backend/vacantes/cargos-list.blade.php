@extends('rrhh.layouts.backend')

@section('breadcrumb')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Vacante</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item active">Listado de cargos</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-info-gradient">Cargos disponibles</div>
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead>
          <tr>
            <th>Título</th>
            <th>-</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td></td>
            <td></td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection