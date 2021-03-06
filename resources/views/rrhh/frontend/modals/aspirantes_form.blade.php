<div class="row">
    <div class="col-12">
        <div id="aspiranteForm" class="aspirante-frm">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('aspirante.store') }}" method="post" id="aspiranteFrm" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cedula">Documento de identidad</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <select name="nacioanlidad" id="nacionalidad" class="form-control">
                                            <option value="v">V</option>
                                            <option value="e">E</option>
                                        </select>
                                    </div>
                                    <input type="text" name="cedula" id="cedula" class="form-control" maxlength="8"
                                           placeholder="Ingrese su cédula" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="nombre" id="name" class="form-control"
                                       placeholder="Ingrese su nombre" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Apellido</label>
                                <input type="text" name="apellido" id="lastname" class="form-control"
                                       placeholder="Ingrese su apellido" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="fecha_nacimiento">Fecha de nacimiento</label>
                            <div class="input-group">
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                                       required>
                                <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="font-weight-bold">Sexo:</p>
                                <label class="mr-2">
                                    <input type="radio" name="sexo" value="f"> F
                                </label>
                                <label>
                                    <input type="radio" name="sexo" value="m"> M
                                </label>
                            </div>
                        </div>
                    </div>

                </fieldset>


                <fieldset>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono_fijo">Teléfono fijo</label>
                                <input type="tel" name="telefono_fijo" id="telefono_fijo" class="form-control"
                                       placeholder="Ingrese su teléfono fijo" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono_movil">Teléfono móvil</label>
                                <input type="tel" name="telefono_movil" id="telefono_movil" class="form-control"
                                       placeholder="Ingrese su teléfono móvil" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Correo electrónico</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="Ingrese su correo electrónico" required>
                                {{--<span v-show="errors.has('email')" class="text-muted text-danger">{{ errors.first('email') }}</span>--}}
                            </div>
                        </div>
                    </div>
                </fieldset>
                <hr>
                <fieldset>
                    <div class="form-group">
                        <label for="curriculum">Resumen curricular <i class="far fa-file-pdf"></i></label>
                        <input type="file" name="curriculum" id="curriculum" class="form-control-file">
                    </div>
                </fieldset>

                <input type="hidden" name="vacante_id" value="{{ $vacante_id }}">
                <input type="hidden" name="cargo_id" value="{{ $cargo_id }}">

                <div class="form-group">
                    <input type="submit" value="Registrar postulación" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
      