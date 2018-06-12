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
    @if (auth()->user()->isRole('analista.area'))
    {{--Filtrado de aspirantes por estatus--}}    
    <aspirante-status :vacante="{{ $vacante }}" estatus="{{ $estatus }}"></aspirante-status>
    <hr>
    {{--Listado de aspirantes--}}
    <aspirante-table :vacante="{{ $vacante }}" :aspirantes="{{ $aspirantes }}"></aspirante-table>
    @else
    <aspirante-status-gerente :vacante="{{ $vacante }}" estatus="{{ $estatus }}"></aspirante-status-gerente>
    <hr>
    <aspirante-table-gerente :vacante="{{ $vacante }}" :aspirantes="{{ $aspirantes }}"></aspirante-table-gerente>        
    @endif
        
  </div>
@endsection
