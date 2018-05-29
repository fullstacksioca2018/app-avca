@extends('rrhh.layouts.backend')

@section('breadcrumb')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Parámetros</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item active">Parámetros de nóminas</li>
        </ol>
      </div>
    </div>
  </div>
@endsection

@section('content')
    <div class="col-12">
        <parametros-nomina></parametros-nomina>
    </div>
@endsection