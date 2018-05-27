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
          <li class="breadcrumb-item active">Roles del sistema</li>
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
      <div class="card-header bg-info-gradient">Listado de roles</div>
      <div class="card-body">
        <div class="float-right">
          @can('roles.create')
            <a href="{{ route('roles.create') }}" class="btn btn-primary">
              <i class="fa fa-plus-square"></i> Rol
            </a>
          @endcan
        </div>
        <div class="clearfix"></div>
        <table class="table table-striped table-hover">
          <thead>
          <tr>
            <th width="10px">ID</th>
            <th>Nombre</th>
            <th>Slug</th>
            <th>Descripción</th>
            <th colspan="3">&nbsp;</th>
          </tr>
          </thead>
          <tbody>
          @foreach($roles as $role)
            <tr>
              <td>{{ $role->id }}</td>
              <td>{{ $role->name }}</td>
              <td>{{ $role->slug }}</td>
              <td>{{ $role->description }}</td>
              <td width="10px">
                @can('roles.show')
                  <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-info">
                    <i class="fa fa-eye"></i>
                  </a>
                @endcan
              </td>
              <td width="10px">
                @can('roles.edit')
                  <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
                    <i class="fa fa-pencil"></i>
                  </a>
                @endcan
              </td>
              <td width="10px">
                @can('roles.destroy')
                  {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'DELETE']) !!}
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
        {!! $roles->render() !!}
      </div>
    </div>
  </div>
@endsection
