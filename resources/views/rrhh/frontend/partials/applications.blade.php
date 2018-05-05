<section class="applications" id="application">
  <div class="container">
    <h2 class="rrhh__title rrhh__title--about">Oportunidades de empleo</h2>
    <div class="owl-carousel owl-theme">
      @foreach($areas as $area)
        <div class="item">
          <div class="card">
            <div class="card-header">{{ $area->nombre }}</div>
            <img src="{{ asset('img'.$area->foto) }}" alt="{{ $area->nombre }}" class="card-img-top" style="flex: 1 1 100%;">
            <div class="card-img-overlay d-flex align-items-end justify-content-center">
              <p class="card-text">
                @foreach($vacantes as $vacante)
                  @if($vacante->area_id == $area->area_id)
                    <a href="{{ route('cargos.get', $area->slug) }}" class="btn btn-lg btn-block btn-success">
                      <i class="fa fa-plus"></i>
                      Información
                    </a>
                  @endif
                @endforeach
              </p>
            </div>
          </div>
        </div>
      @endforeach

    </div>
    {{--<oportunidades></oportunidades>--}}
  </div>
</section>
