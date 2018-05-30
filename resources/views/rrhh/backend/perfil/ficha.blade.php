@extends('rrhh.layouts.backend')

@section('breadcrumb')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Datos del empleado</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item active">Datos empleado</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
  {{-- Buscador --}}  
  <div class="col-md-4 offset-md-4 mb-3">
    {{--<buscador></buscador>--}}
    <form action="{{ route('empleado.info') }}" method="post">
      @csrf
      <div class="input-group">
        <input type="search" name="search" id="search" placeholder="Ingrese cédula del empleado" class="form-control">
        <div class="input-group-append">
          <button type="submit" class="btn btn-info">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
  @if(isset($empleado))
    {{--Ficha del empleado--}}
    <ficha-empleado ruta="{{ url('') }}" :empleado="{{ $empleado }}"></ficha-empleado>
  @endif

@endsection

@push('scripts')

@endpush
