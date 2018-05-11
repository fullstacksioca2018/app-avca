<P>Estimad@: <strong>{{ $nombre }}</strong></P>
<p>En nombre de AVCA, deseo agradecerle su recitente solicitud de empleo en nuestra compañía.</p>
<p>Tengo el agrado de informarle que hemos programado una entrevista para usted.</p>
<p><strong>Fecha:</strong> {{ date("d/m/Y", strtotime($fecha)) }}</p>
<p><strong>Hora:</strong> {{ $hora }}</p>
<p><strong>Lugar:</strong> {{ $lugar }}</p>
<p><strong>Recaudos a consignar:</strong></p>
<ul>
  @foreach($recaudos as $recaudo)
    <li>{{ $recaudo }}</li>
  @endforeach
</ul>

<br>
<p>Atentamente,</p>

<p>
    <span>Analista de Personal</span> <br>
    <span>0293-4332040</span> <br>
    <span>04167834720</span>
</p>

