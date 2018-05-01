@extends('cliente.template.main2')
@section('title','Equipaje')
	
@section('content')
	<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-10 px-0">
          <h3 class=" font-italic">INFORMACIÓN DE EQUIPAJE</h3>
          <p class="lead my-3">Todo lo que necesitas saber sobre las normas de Alas de Venezuela C.A. en cuanto a equipaje.</p>
          
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-success">Equipaje Permitido</strong>
              
             
              <p class="card-text mb-auto text-justify">   Dinero, cheques, joyas y perfumes.<br>
                 Ipods, ipads, reproductores MP4 y MP3.<br>
                 Calculadoras, computadoras personales y tablets.<br>
                 Documentos personales.<br>
                 Vajillas, cerámicas y botellas con licor.<br>
                 Gafas o lentes.<br>
                 Cintas de películas y cassette de videos.<br>
                 Celulares, cargadores.<br>
                 Discos compactos, discos Blu-ray.</p>
              
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" src="{{ asset('img/equipaje/permitido.jpg') }}" height="200px" alt="Eqipaje Permitido">
          </div>
        </div>
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-danger">Equipaje Peligroso</strong>
              
              <p class="card-text mb-auto text-justify">Explosivos y armas.
                Gases.<br>
                Líquidos inflamables.<br>
                Sólidos inflamables, sustancias que representen riesgos de combustión espontánea; sustancias que en contactos con el agua emitan gases inflamables.<br>
                Sustancias combustibles, peróxidos orgánicos.<br>
                Sustancias Venenosas (tóxicas) y sustancias infecciosas.<br>
                Material radioactivo.<br>
                Sustancias corrosivas.<br>
                Sustancias peligrosas varias. Cualquier sustancia u objetos que represente peligro no previstos en las clases anteriores.</p> 
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" src="{{ asset('img/equipaje/peligroso.png') }}" height="190px" alt="Equipaje Peligroso">
          </div>
        </div>
      </div>
    </div>


    <div class="row mb-2">
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">Equipaje de Mano</strong>
              
             
              <p class="card-text mb-auto text-justify">    El equipaje de Mano permitido para ser colocado en el compartimiento ubicado en la parte superior del asiento (SOMBRERERA) o que pueda ser colocado debajo de éste sin ocasionar molestias a los pasajeros ni obstruir el paso, pueden ser:<br>
              Maletín de mano ejecutivo.<br>
              Maletín de mano tipo piloto.<br>
              Maletín de mano para dama (NECESER).<br>
              Bolsos de mano en general.<br>
              Muletas o cualquier otro tipo de auxiliar o prótesis necesarios, siempre que el pasajero dependa de su uso para movilizarse.</p>
              
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" src="{{ asset('img/equipaje/mano.jpg') }}" height="150px" alt="Eqipaje de Mano Permitido">
          </div>
        </div>
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">Equipaje Facturado</strong>
              
              <p class="card-text mb-auto text-justify">Es aquel por cuya custodia responde exclusivamente el transportista, y por el cual, emite un ticket de equipaje facturado. El mismo tiene dos porciones, la del pasajero para reclamarlo en su destino final y la que se coloca en el equipaje para ser transportado.

    El usuario no debe incluir en su equipaje facturado, artículos frágiles o perecederos, tales como, dinero, joyas, piedras o metales preciosos, platería, documentos negociables, títulos u otros valores; dinero en efectivo, pasaportes, cámaras fotográficas o de video, filmadoras, computadoras, calculadoras, lentes, o botellas con licor, equipos médicos, teléfonos móviles, o cualquier otro objeto de valor o frágil, respecto de los cuales el transportista aéreo no se responsabiliza si se transporta en esas condiciones.</p>
          
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" src="{{ asset('img/equipaje/facturado.png') }}" height="200px" alt="Equipaje Facturado">
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 ">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-warning">IMPORTANTE:</strong>
              
              <p class="card-text mb-auto">
          <p class="card-text mb-auto text-justify"> 
            EN VUELOS NACIONALES
            1 pieza de 23kg (equipaje facturado).<br>
            1 pieza de 5Kg (equipaje de mano).<br>
            Los cargos por exceso de equipaje se calculan en base al 1% del costo de la tarifa base one way (OW) más alta en la ruta, más Iva.</p></p>
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" src="{{ asset('img/equipaje/importante.jpg') }}" height="150px" alt="Equipaje Peligroso">
          </div>
        </div>
      </div>
    </div>

@endsection