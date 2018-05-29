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
          <li class="breadcrumb-item active">Usuarios del sistema</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
  <div class="col-12">
    @if(session('info'))
      <div class="alert alert-success">
        {{ session('info') }}
      </div>
    @endif
    <div class="card">
      <div class="card-header bg-info-gradient">Listado de usuarios</div>
      <div class="card-body">
        <div class="float-right">
          @can('users.create')
          <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="fa fa-plus-square"></i> Usuario
          </a>
          @endcan
        </div>
        <div class="clearfix"></div>
        <table class="table table-striped table-hover">
          <thead>
          <tr>
            <th width="10px">ID</th>
            <th>Rol</th>
            <th>Nombre</th>
            <th>Email</th>
            <th colspan="3">&nbsp;</th>
          </tr>
          </thead>
          <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>
              @foreach ($user->getRoles() as $roles)
                <span class="badge badge-info text-capitalize">
                {{ $roles }}
                </span>
              @endforeach
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td width="10px">
              @can('users.show')
                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">
                  <i class="fa fa-eye"></i>
                </a>
              @endcan
            </td>
            <td width="10px">
              @can('users.edit')
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                  <i class="fa fa-pencil"></i>
                </a>
              @endcan
            </td>
            <td width="10px">
              @can('users.destroy')
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                  <button class="btn btn-sm btn-danger">
                    <i class="fa fa-close"></i>
                  </button>
                {!! Form::close() !!}
              @endcan
            </td>
          </tr>
          @endforeach
          </tbody>
        </table>
        {!! $users->render() !!}
      </div>
    </div>
  </div>
@endsection
