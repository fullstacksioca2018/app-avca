@extends('operativo.layouts.backend')

@section('content')

   
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div class="card">
              <div class="card-header text-center">
                <strong>Gestionar Taquilla </strong>
              </div>
              <div class="card-body">
                <div class="form-group ">
                  <div class="col-form-label text-center">
                    <div class="btn-group align-items-center" role="group" aria-label="Basic example">
                      <!-- <button href="#" type="button" class="btn btn-primary btn-lg active"> Sin Retorno</button> -->
                      <a href="#" id="btsoloida" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">solo ida</a>
                      <a href="#" id="btidayvuelta" class="btn btn-primary btn-lg" role="button" aria-pressed="true">ida y vuelta</a>
                      <a href="#" id="btmultidestino" class="btn btn-primary btn-lg" role="button" aria-pressed="true">multi-destino</a>
                    </div>
                  </div>
                </div>

               <div id="soloida">
               {!! Form::open(['route' => ['taquilla.DetalleVuelo'], 'method' => 'GET', 'id'=> 'FormIda']) !!}
               <input type="hidden" name="tipo" id="tipo" value="1">
                 @include('operativo.taquilla.ida')
                 <div class="card-footer text-center">
                <button type="submit" id="btnIda" class="btn  btn-primary">
                  <i class="fa fa-dot-circle-o"> Aceptar</i>
                </button>
                <button type="reset " class="btn  btn-danger">
                  <i class="fa fa-ban"> Cancelar</i>
                </button>
                {!! Form::close() !!}
              </div>

               </div>
               <div id="idayvuelta">
               {!! Form::open(['route' => ['taquilla.DetalleVuelo'], 'method' => 'GET', 'id'=> 'FormIdayVuelta']) !!}
               <input type="hidden" name="tipo" id="tipo" value="2">
                   @include('operativo.taquilla.idayvuelta')
                   <div class="card-footer text-center">
                <button type="submit" id="btnIdayVuelta" class="btn  btn-primary">
                  <i class="fa fa-dot-circle-o"> Aceptar</i>
                </button>
                <button type="reset " class="btn  btn-danger">
                  <i class="fa fa-ban"> Cancelar</i>
                </button>
                {!! Form::close() !!}
              </div>

               </div>
               <div id="multidestino">
               {!! Form::open(['route' => ['taquilla.DetalleVuelo'], 'method' => 'GET', 'id'=> 'FormMultidestino']) !!}
               <input type="hidden" name="tipo" id="tipo" value="3">
                   @include('operativo.taquilla.multidestino')
                   <div class="card-footer text-center">
                <button type="submit" id="btnMultidestino"  class="btn  btn-primary">
                  <i class="fa fa-dot-circle-o"> Aceptar</i>
                </button>
                <button type="reset " class="btn  btn-danger">
                  <i class="fa fa-ban"> Cancelar</i>
                </button>
                {!! Form::close() !!}
              </div>

               </div>
                   
                </div>  
               

             
                
     
              
            </div>
          </div>
        </div>
      </div>
    </div>

@push('styles')
<link href="{{asset('css/chosen.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-chosen.css')}}" rel="stylesheet">
<style type="text/css">
  .oculta{
    display: none;
  }
</style>
@endpush

@push('scripts')
<script src="{{asset('js/Operativo/jspersonal.js')}}"></script>

<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('online/plugins/lib/chosen/chosen.jquery.js') }}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">

  $(function() {
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
      });

  
  $(document).ready(function(){
     $('#idayvuelta').addClass('oculta');
    $('#multidestino').addClass('oculta');

    $('#btsoloida').click(function(){
      if(!$('#btsoloida').hasClass('active')){
        $('#btsoloida').addClass('active');
       
        $('#btidayvuelta').removeClass('active');
        $('#btmultidestino').removeClass('active');
        $('#idayvuelta').addClass('oculta');
        $('#multidestino').addClass('oculta');

         $('#soloida').removeClass('oculta');
       
      }
    });
     $('#btidayvuelta').click(function(){
      if(!$('#btidayvuelta').hasClass('active')){
        $('#btidayvuelta').addClass('active');
       
        $('#btsoloida').removeClass('active');
        $('#btmultidestino').removeClass('active');
        $('#soloida').addClass('oculta');
        $('#multidestino').addClass('oculta');

         $('#idayvuelta').removeClass('oculta');
       
      }
    });
      $('#btmultidestino').click(function(){
      if(!$('#btmultidestino').hasClass('active')){
        $('#btmultidestino').addClass('active');
       
        $('#btsoloida').removeClass('active');
        $('#btidayvuelta').removeClass('active');
        $('#soloida').addClass('oculta');
        $('#idayvuelta').addClass('oculta');

         $('#multidestino').removeClass('oculta');
       
      }
    });
     //fecha de regreso para Ida y Vuelta
    $("#fecha_salida2").change(function(){
        $("#fecha_regreso").attr({
          min: $("#fecha_salida2").val(),
          value: $("#fecha_salida2").val()
        })
      });
    
  
  });

 

</script>
@endpush




@stop


