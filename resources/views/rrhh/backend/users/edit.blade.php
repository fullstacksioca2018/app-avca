@extends('rrhh.layouts.backend')

@section('breadcrumb')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Usuarios</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Listado de usuarios</a></li>
          <li class="breadcrumb-item active">Editar usuario</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-info-gradient">Edición de usuario</div>
      <div class="card-body">
        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}
          @include('rrhh.backend.users.partials.form')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
