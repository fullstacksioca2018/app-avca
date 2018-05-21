@extends('operativo.layouts.backend')

@section('content')

   
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="row"> 
          <div class="col-md-7"><!-- TAQUILLA -->
            <div class="card">
              <div class="card-header text-center">
                <strong>Gestionar Taquilla </strong>
              </div>
              <div class="card-body">
                <div class="form-group ">
                  <div class="col-form-label text-center">
                    <div class="btn-group align-items-center" role="group" aria-label="Basic example">
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
                <button type="submit" id="btnIda" class="btn  btn-primary" name="btn_ida" >
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
                <button type="submit" id="btnIdayVuelta" class="btn  btn-primary" name="btn_idayvuelta">
                  <i class="fa fa-dot-circle-o"> Aceptar</i>
                </button>
                <button type="reset " class="btn  btn-danger" >
                  <i class="fa fa-ban"> Cancelar</i>
                </button>
                {!! Form::close() !!}
              </div>

               </div>
               <div id="multidestino">
               {!! Form::open(['route' => ['taquilla.DetalleVuelo'], 'method' => 'GET', 'id'=> 'FormMultidestino']) !!}
               <input type="hidden" name="tipo" id="tipo" value="3">
               <input type="hidden" name="cantidadV" id="cantidadV" value="2">
                   @include('operativo.taquilla.multidestino')
                   <div class="card-footer text-center">
                <button type="submit" id="btnMultidestino"  class="btn  btn-primary" name="btn_multidestino">
                  <i class="fa fa-dot-circle-o"> Aceptar</i>
                </button>
                <button type="reset " class="btn  btn-danger" >
                  <i class="fa fa-ban"> Cancelar</i>
                </button>
                {!! Form::close() !!}
              </div>

               </div>
                   
                </div>  
            </div>
          </div>

          <!-- ----------------AQUI INFORMACION DE LOS VUELOS----------------------------- -->

          <div class="col-md-5">
              <div class="card">
                <div class="card-header text-center">
                  <strong>Panel de control </strong>
                </div>
                <div class="card-body">
                   <!-- VUELOS -->
                    <div id="resultados_vuelo_1"></div>
                    <div id="resultados_vuelo_2"></div>
                    <div id="resultados_vuelo_3"></div>
                    <div id="resultados_vuelo_3"></div>
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
<script src="{{asset('js/Operativo/multidestino.js')}}"></script>
 
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('online/plugins/lib/chosen/chosen.jquery.js') }}" type="text/javascript" charset="utf-8"></script>

@endpush




@stop


