<div class="aspirantes__filter py-3">
  {{ $estatus }}
  <ul class="nav nav-pills justify-content-center">
    <li class="nav-item">
      @if($estatus == 'registrados')
      <a href="{{ route('aspirantes.obtener-estatus', [$vacante, $estatus = 'registrados']) }}"
         class="nav-link active">Registrados
      </a>
      @else
        <a href="{{ route('aspirantes.obtener-estatus', [$vacante, $estatus = 'registrados']) }}"
           class="nav-link">Registrados
        </a>
      @endif
    </li>
    <li class="nav-item">
      @if($estatus == 'verificados')
        <a href="{{ route('aspirantes.obtener-estatus', [$vacante, $estatus = 'verificados']) }}"
           class="nav-link active">Verificados
        </a>
      @else
        <a href="{{ route('aspirantes.obtener-estatus', [$vacante, $estatus = 'verificados']) }}"
           class="nav-link">Verificados
        </a>
      @endif
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
</div>