@extends('rrhh.layouts.backend')

@push('styles')
@endpush

@section('content')
  <div class="container">
    <div class="row aspirantes">
      <div class="col-12">

        {{--Filtrado de aspirantes por estatus--}}
        <aspirante-status></aspirante-status>
        <vacante-filter></vacante-filter>

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
