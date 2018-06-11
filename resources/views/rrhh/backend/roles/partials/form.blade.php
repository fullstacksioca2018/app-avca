<div class="form-group">
  {!! Form::label('name', 'Nombre') !!}
  {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('slug', 'Slug') !!}
  {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('description', 'Descripción') !!}
  {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<hr>
<h3>Permiso especial</h3>
<div class="form-group">
  <label class="mr-3">{{ Form::radio('special', 'all-access') }} Acceso total</label>
  <label>{{ Form::radio('special', 'no-access') }} Ningún acceso</label>
</div>
<hr>
<h3 class="text-center">Lista de permisos</h3>
<hr>
<div class="row">
  @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_users])
    @slot('title')
      Usuarios
    @endslot
  @endcomponent

  @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_roles])
    @slot('title')
      Roles
    @endslot
  @endcomponent

  @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_areas])
    @slot('title')
      Áreas
    @endslot
  @endcomponent

  @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_aspirantes])
    @slot('title')
      Aspirantes
    @endslot
  @endcomponent

  @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_carga_familiar])
    @slot('title')
      Carga familiar
    @endslot
  @endcomponent

  @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_cargos])
    @slot('title')
      Cargos
    @endslot
  @endcomponent

  @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_conceptos])
    @slot('title')
      Conceptos
    @endslot
  @endcomponent

  @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_empleados])
    @slot('title')
      Empleados
    @endslot
  @endcomponent

  @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_entrevistas])
    @slot('title')
      Entrevistas
    @endslot
  @endcomponent

  @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_expedientes])
    @slot('title')
      expedientes
    @endslot
  @endcomponent

  @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_nominas])
    @slot('title')
      nominas
    @endslot
  @endcomponent

  @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_profesiones])
    @slot('title')
      profesiones
    @endslot
  @endcomponent

    @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_sucursales])
      @slot('title')
        sucursales
      @endslot
    @endcomponent

    @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_tabuladores_salariales])
      @slot('title')
        tabuladores salariales
      @endslot
    @endcomponent

    @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_vacantes])
      @slot('title')
        vacantes
      @endslot
    @endcomponent

    @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_variables])
      @slot('title')
        variables
      @endslot
    @endcomponent

    @component('rrhh.backend.roles.components.permissions', ['permisos' => $permissions_vouchers])
      @slot('title')
        vouchers
      @endslot
    @endcomponent
</div>

<div class="form-group">
  {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
</div>
