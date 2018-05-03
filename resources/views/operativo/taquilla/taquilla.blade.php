@extends('operativo.layouts.app')

@section('content')

   {!! Form::open(['route' => ['taquilla.DetalleVuelo'], 'method' => 'GET', 'onsubmit' => 'myFunction()']) !!}
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div class="card">
              <div class="card-header text-center">
                <strong>Gestionar Taquilla</strong>
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
                 @include('operativo.taquilla.ida')

               </div>
               <div id="idayvuelta">
                   @include('operativo.taquilla.idayvuelta')

               </div>
               <div id="multidestino">
                   @include('operativo.taquilla.multidestino')

               </div>
                   
                </div>  
               

             
                
     
              <div class="card-footer text-center">
                <button type="submit" class="btn  btn-primary">
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
 

<script type="text/javascript">

$('#sandbox-container input').datepicker({
    language: "es",
    autoclose: true,
    todayHighlight: true
});
 



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
  });


</script>

<style type="text/css">
  .oculta{
    display: none;
  }
</style>




@stop


