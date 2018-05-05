@extends ('rrhh.layouts.frontend')

@section('content')
  <div class="container py-5 mt-5">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-info text-white text-uppercase category-name">Área: <b>{{ $area }}</b></div>
          <div class="card-body">
            <table class="table table-striped category-table">
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
                  <td class="text-capitalize">{{ $vacante->titulo }}</td>
                  <td>{{ $vacante->nombre }}</td>
                  <td>{{ Carbon\Carbon::parse($vacante->fecha_publicacion)->format('d/m/Y')  }}</td>
                  <td>
                    <a href="{{ route('perfil.show', [$vacante->vacante_id, $vacante->cargo_id]) }}" class="btn btn-info btn-sm text-white">
                      <i class="fas fa-arrow-right"></i>
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