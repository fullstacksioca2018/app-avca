@extends('rrhh.layouts.backend')

@section('content')
  <div class="container">
    <div class="row aspirantes">
      <div class="col-12">
        {{--<div class="vacante">
          <div class="vacante__search">
            <h4 class="vacante__title">Vacante a consultar</h4>
            <form action="#" class="form-row">
              <div class="col-md-4">
                <div class="input-group row">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Sucursal</span>
                  </div>
                  <select name="sucursal" id="sucursal" class="form-control">
                    <option value="" selected="selected">Buscar en sucursal</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="input-group row">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Área</span>
                  </div>
                  <select name="area" id="area" class="form-control">
                    <option value="" selected="selected">Buscar en área</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="input-group row">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Cargo</span>
                  </div>
                  <select name="cargo" id="cargo" class="form-control">
                    <option value="" selected="selected">Buscar en cargo</option>
                  </select>
                </div>
              </div>
            </form>
          </div>
        </div>--}}
        {{--Filtrado de aspirantes por estatus--}}
        <aspirante-status></aspirante-status>
        <vacante-filter></vacante-filter>
        {{--<div class="aspirantes__filter pt-3">
          <ul class="nav justify-content-center">
            <li class="nav-item">
              <a href="#" class="nav-link">Registrados</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Verificados</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Convocados</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Entrevistados</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Seleccionados</a>
            </li>
          </ul>
        </div>--}}
        <hr>

        {{--Listado de aspirantes--}}
        <aspirante-table></aspirante-table>
        {{--<div class="aspirantes__table">
          <div class="card">
            <div class="card-header bg-info-gradient">
              <h4 class="text-center aspirantes__title">Aspirantes Registrados</h4>
            </div>
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Nombre y Apellido</th>
                    <th>Curriculum</th>
                    <th>Verificar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>--}}
      </div>
    </div>
  </div>
@endsection
