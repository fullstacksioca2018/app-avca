@extends('rrhh.layouts.backend')

@section('breadcrumb')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Roles</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Listado de roles</a></li>
          <li class="breadcrumb-item active">Editar rol</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-info-gradient">Edición de rol</div>
      <div class="card-body">
        {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) !!}
        @include('rrhh.backend.roles.partials.form')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
