@extends('rrhh.layouts.backend')

@push('styles')
@endpush

@section('breadcrumb')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Selección</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item active">Seleccionar aspirantes</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
  <div class="container">
    <div class="row aspirantes">
      <div class="col-12">

        {{--Filtrado de aspirantes por estatus--}}
        <aspirante-status></aspirante-status>
        {{--  <vacante-filter></vacante-filter>  --}}

        <hr>

        {{--Listado de aspirantes--}}
        <aspirante-table></aspirante-table>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    // Tooltip
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });
  </script>
@endpush
