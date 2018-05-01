@extends('cliente.template.main2')
@section('title','Equipaje')
	
@section('content')

<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-10 px-0">
          <h3 class=" font-italic">INFORMACIÓN SOBRE DOCUMENTACIÓN</h3>
          <p class="lead my-3">Todo lo que necesitas saber sobre las normas de Alas de Venezuela C.A. en cuanto a la documentación que debes presentar.</p>
          
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">Personas con Discapacidad</strong>
              
             
              <p class="card-text mb-auto text-justify">   Para la compra de boletos para pasajeros con discapacidad, deberá presentar original y copia de la cédula de identidad legible y del carnet expedido por el Consejo Nacional para las Personas con Discapacidad (CONAPDI) para poder disfrutar de la tarifa especial.</p>
              
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" src="{{ asset('img/documentacion/discapacitados.png') }}" height="150px" alt="Discapacitados">
          </div>
        </div>
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">Adultos Mayores</strong>
              
              <p class="card-text mb-auto text-justify">Para la compra de boletos para adultos mayores (personas a partir de los 60 años cumplidos), deberán presentar copia de la cédula de identidad legible, para poder disfrutar de la tarifa especial.</p>
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" src="{{ asset('img/documentacion/am.png') }}" height="145px" alt="Adultos Mayores">
          </div>
        </div>
      </div>
    
<h2 class="text-center text-primary">MENORES DE EDAD</h2>

    <div class="row mb-3">
        <div class="col-md-4">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">Artículos</strong>
              
             
              <p class="card-text mb-auto text-justify"><strong>La Ley Orgánica para la Protección del Niño, Niña y Adolescente</strong> <br>
             <strong>Artículo 391. Viajes dentro del país.</strong><br>
              Los niños, niñas y adolescentes pueden viajar dentro del país acompañados por sus padres, representantes o responsables. En caso de viajar solos o con terceras personas requieren autorización de un representante legal, expedida por el Consejo de Protección de Niños, Niñas y Adolescentes, por una jefatura civil o mediante documento autenticado.<br>
              <strong>Artículo 393. Intervención Judicial.</strong><br>
              En caso que la persona o personas a quienes corresponda otorgar el consentimiento para viajar se negare a darlo o hubiere desacuerdo para su otorgamiento, el padre o madre que autorice el viaje, o el hijo o hija si es adolescente, puede acudir ante el juez o jueza y exponerle la situación, a fin de que éste decida lo que convenga a su interés superior.

              Conviasa cuenta con tarifas especiales para niños e infantes en todos sus vuelos nacionales e internacionales.</p>
              
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" src="{{ asset('img/documentacion/ley.jpg') }}" height="70px" alt="Leyes">
          </div>
        </div>
        <div class="col-md-4">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">Aplica a:</strong>
              
              <p class="card-text mb-auto text-justify">Infantes: Hasta 3 años no cumplidos.<br>
              Niños: Hasta 13 años no cumplidos.<br>

            <strong>Recaudos para trámite de permisos a menores:</strong>
             Cédula de identidad (original y copia), de los padres o representante legal del menor.<br>
             Partida de nacimiento o cédula de identidad (original y copia) del menor.</p>
          
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" src="{{ asset('img/documentacion/ninos.jpg') }}" height="80px" alt="Niños">
          </div>
        </div>
        <div class="col-md-4">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">En el Aeropuerto le será solicitada la siguiente documentación:</strong>
              
             
              <p class="card-text mb-auto text-justify">Si el menor viaja con los padres:
             <strong>Original y copia de la partida de nacimiento del menor.</strong><br>
             Si el menor viaja solo:
             <strong>Permiso notariado o emitido por el Consejo de Protección del Niño y Adolescente firmado por los padres.<br>
              Original y copia de la partida de nacimiento.</strong><br>
              Si el menor viaja con terceros:
              <strong>Permiso notariado o emitido por el Consejo de Protección del Niño y Adolescente firmado por los padres.<br>
              Original y copia de la partida de nacimiento.<br>
              Copia de la cédula de identidad de los padres.</strong></p>
              
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" src="{{ asset('img/documentacion/pass.jpg') }}" height="90px" alt="Pasaporte">
          </div>
        </div>
      </div>
 



    <!---->
    <h2 class="text-center text-primary">RECOMENDACIONES</h2>

    <div class="row mb-3">
        <div class="col-md-2">
              
            </div>
            
        <div class="col-md-8">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">Recomendaciones</strong>
              
             
              <p class="card-text mb-auto text-justify">    <STRONG>
                Identifique su equipaje con sus datos personales.<br>
                Lleve sus artículos de valor en su equipaje de mano.<br>
                Reclame su equipaje inmediatamente a la llegada del vuelo.<br>
                Realice su respectivo reclamo con el personal de la aerolínea, si su equipaje no arriba en el mismo vuelo.</p>
              </STRONG>
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" src="{{ asset('img/documentacion/lista.png') }}" height="150px" alt="Recomendaciones">
          </div>
        </div>
        
       
    <!---->

@endsection