@extends ('rrhh.layouts.backend')

@section('breadcrumb')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Sección del empleado</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">Inicio</li>          
        </ol>
      </div>
    </div>
  </div>
@endsection

@section('content')  
  @if(!Auth::user()->isRole('empleado'))
  <div>
    <img src="{{ asset('img/rrhh/imagen_principal.png') }}" class="img-fluid" alt="">
  </div>
  @else    
    @if(isset($empleado))
      {{--Ficha del empleado--}}
      <ficha-empleado ruta="{{ url('') }}" :empleado="{{ $empleado }}"></ficha-empleado>
    @endif
  @endif
  {{--<h1>Dashboard</h1>--}}
@endsection

