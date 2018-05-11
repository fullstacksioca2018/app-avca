@extends('rrhh.layouts.backend')

@section('content')
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-info-gradient">
        <h2 class="form-title">Contratación</h2>
      </div>
      <div class="card-body">
        {{--Componente buscador--}}
        <buscador form-id="ContratacionForm"></buscador>
        <hr>

        @if(count($aspirante) > 0)
        <form action="#" id="ContratacionForm">
          {{--Datos personales--}}
          @include('rrhh.backend.captacion.contratacion.datos.personales', ['aspirante' => $aspirante])
          <hr>
          {{--Datos de habitacion--}}
          @include('rrhh.backend.captacion.contratacion.datos.habitacion', ['aspirante' => $aspirante])

          <button type="submit" class="btn btn-success">
            <i class="fa fa-check"></i> Guardar y generar contrato
          </button>
        </form>
        @endif
      </div>
    </div>
  </div>
  @{{ message }}
@endsection

@push('scripts')
  <script>
    new Vue({
      el: '#rrhh',
      data: {
        message: "Helloooooo"
      }
    })
  </script>
@endpush
