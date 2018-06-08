@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{!! Form::model($empleado, ['route' => ['empleado.actualizar-ficha', $empleado->empleado_id], 'files' => true, 'method' => 'PUT']) !!}
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('nombre', 'Nombre') !!}
                {!! Form::text('nombre', null, ['class' => 'form-control', 'readonly']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('apellido', 'Apellido') !!}
                {!! Form::text('apellido', null, ['class' => 'form-control', 'readonly']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('foto', 'Foto') !!}
                {!! Form::file('foto', ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('estado_civil', 'Estado civil') !!}
                {!! Form::text('estado_civil', null, ['class' => 'form-control', 'readonly']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('fecha_nacimiento', 'Fecha de nacimiento') !!}
                {!! Form::date('fecha_nacimiento', null, ['class' => 'form-control', 'readonly']) !!}
            </div>
        </div>
        <div class="col-md-1">
            {!! Form::label('sexo', 'Sexo') !!}
            {!! Form::text('sexo', null, ['class' => 'form-control', 'readonly']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('nivel_academico', 'Nivel académico') !!}
                {!! Form::text('nivel_academico', null, ['class' => 'form-control', 'readonly']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('profesion', 'Profesión') !!}
                {!! Form::text('nombre_profesion', $datos_personales->nombre_profesion, ['class' => 'form-control', 'readonly']) !!}
                {!! Form::hidden('profesion', null) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('estado', 'Estado') !!}
                {!! Form::text('estado', null, ['class' => 'form-control', 'readonly']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('ciudad', 'Ciudad') !!}
                {!! Form::text('ciudad', null, ['class' => 'form-control', 'readonly']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('direccion', 'Dirección') !!}
                {!! Form::text('direccion', null, ['class' => 'form-control', 'readonly']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('telefono_fijo', 'Teléfono fijo') !!}
                {!! Form::text('telefono_fijo', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('telefono_movil', 'Teléfono movil') !!}
                {!! Form::text('telefono_movil', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('email', 'Correo electrónico') !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'readonly']) !!}
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <button type="submit" class="btn btn-info">Actualizar datos</button>
    </div>

    <input type="hidden" name="cedula" value="{{ $empleado->cedula }}">

{!! Form::close() !!}