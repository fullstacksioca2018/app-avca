@extends('rrhh.layouts.backend')

@section('content')
  {{--Formulario de contratacion--}}
  <contratacion></contratacion>
@endsection

@push('scripts')
  @include('sweet::alert')
@endpush
