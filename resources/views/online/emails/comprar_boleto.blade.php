<P>Estimado: <strong>{{ $usuarios->name }}</P>
<p>En nombre de AVCA, le informamos que su compra fue exitosa</p>
<p>En la parte de abajo podrá vusualizar el localizador para el chequeo del boleto.</p>

<hr>

<table class="table-sm">
    <thead>
            <div class="table-detalles"><img src="{{ asset('online/img/logo.png') }} " height="200px" class="d-inline-block align-right" alt="AVCA" style="margin-left: 170px"></div>
            
    </thead>
  
  <tbody>

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
      <td class="thresumen">{{ $dato_vuelo->origen->sigla }}-{{ $dato_vuelo->destino->sigla }}</td>
      <td class="thresumen">{{ $salida->format('h:i A') }}-{{ $llegada->format('h:i A') }}</td>
      <td class="thresumen">{{ $fecha->format('d/m/Y') }}</td>
      <td class="thresumen">Costo: {{ $dato_vuelo->ruta->tarifa_vuelo }}</td>
    </tr>

      @for($i = 0; $i < $factura->ninos_cant + $factura->adultos_cant; $i++)
        <tr>

          <th class="thresumen">Pasajero: {{ $boletos[$i]->primerNombre }} {{ $boletos[$i]->apellido }}</th>

          <th class="thresumen">Localizador: {{ $boletos[$i]->localizador }} </th>

        </tr>
            
      @endfor
    

    @endforeach
    <tr class="table-detalles">
      <td class="thresumen">Cantidad pasajeros: {{ $factura->ninos_cant + $factura->adultos_cant }}</td>
      <td class="thresumen">Costo Total: {{ $factura->importe_facturado }}</td>
      <td class="thresumen2"></td>
      <td class="thresumen2"></td>
      <td></td>

    </tr>

  </tbody>
 </table>

<br>
<p>Atentamente,</p>

<p>
    <span>AVCA</span> <br>
    <span>0293-4332040</span> <br>
    <span>04167834720</span>
</p>