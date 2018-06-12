@extends('rrhh.layouts.backend')

@section('content')
  <div class="col-12">
    @if(session('info'))
      <div class="alert alert-success">
        {{ session('info') }}
      </div>
    @endif
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h4>Listado de cargos</h4>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead>
          <tr>
            <th>Título</th>
            <th>Área</th>
            <th>Tabulador salarial</th>
            <th>Acciones</th>
          </tr>
          </thead>
          <tbody>
          @foreach($cargos as $cargo)
            <tr>
              <td>{{ $cargo->titulo }}</td>
              <td>{{ $cargo->nombre }}</td>
              <td>Bs. {{ $cargo->sueldo_base }}</td>
              <td>
                <a href="{{ route('cargo.edit', $cargo->cargo_id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Editar perfil del cargo">
                  <i class="fa fa-edit"></i>
                </a>
                {{--<a href="{{ route('cargo.vacante', $cargo->cargo_id) }}" class="btn btn-success btn-sm ml-2" data-toggle="tooltip" data-placement="top" title="Activar cargo como vacante">
                  <i class="fa fa-check-circle"></i>
                </a>--}}
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
        <div class="mt-3">
          {{ $cargos->render() }}
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
@endpush