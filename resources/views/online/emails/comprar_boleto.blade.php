<P>Estimado: <strong>{{ $usuarios->name }}</P>
<p>En nombre de AVCA, le informamos que su compra fue exitosa</p>
<p>En la parte de abajo podrá revisar los localizadores para el checking del boleto.</p>

<table class="table-sm ">
    <thead>
            <div class="table-detalles"><img src="{{ asset('online/img/logo.png') }} " height="40" class="d-inline-block align-right" alt="AVCA"></div>
            
          </thead>
    
   @foreach ($datos_vuelos as $dato_vuelo)
      @php
        $salida = Carbon::parse($dato_vuelo->vuelo->fecha_salida);
        $fecha = Carbon::parse($dato_vuelo->vuelo->fecha_salida);
        $hora=Carbon::parse($dato_vuelo->ruta->duracion);
        $llegada=$salida->copy();
        $llegada->addHours($hora->hour);
        $llegada->addMinutes($hora->minute);
      @endphp

    <tr>
      <th class="thresumen">{{ $dato_vuelo->origen->sigla }}-{{ $dato_vuelo->destino->sigla }}</th>
      <th class="thresumen">{{ $salida->format('h:i A') }}-{{ $llegada->format('h:i A') }}</th>
      <th class="thresumen">{{ $fecha->format('d/m/Y') }}</th>
      <th class="thresumen">Costo: {{ $dato_vuelo->ruta->tarifa_vuelo }}</th>
    </tr>

      @foreach ($boletos as $boleto)
        <tr>

          <th class="thresumen">Pasajero: {{ $boleto->primerNombre }} {{ $boleto->apellido }}</th>

          <th class="thresumen">Localizador: {{ $boleto->localizador }} </th>

        </tr>
      @endforeach
    

    @endforeach
    <tr class="table-detalles">
      <th class="thresumen">Cantidad pasajeros: {{ $factura->ninos_cant + $factura->adultos_cant }}</th>
      <th class="thresumen">Costo Total: {{ $factura->importe_facturado }}</th>
      <th class="thresumen2"></th>
      <th class="thresumen2"></th>
      <th></th>

    </tr>


  </table>

<br>
<p>Atentamente,</p>

<p>
    <span>AVCA</span> <br>
    <span>0293-4332040</span> <br>
    <span>04167834720</span>
</p>