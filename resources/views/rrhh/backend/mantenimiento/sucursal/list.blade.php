@extends('rrhh.layouts.backend')

@section('breadcrumb')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Sucursales</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item active">Listado de sucursales</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="col-12">
        {{--  Mensajes  --}}
        @if (session('message'))
            @if (session('message') == 'success')
                <p class="text-success text-center">Sucursal registrada exitosamente!</p>
            @else
                <p class="text-danger text-center">Ocurrió un error. Por favor intente nuevamente!</p>
            @endif
        @endif
        <listado-sucursales :sucursales="{{ $sucursales }}"></listado-sucursales>
        {{--  Carga de modal  --}}
        @include('rrhh.backend.mantenimiento.sucursal.modals.agregar')                
    </div>
@endsection
