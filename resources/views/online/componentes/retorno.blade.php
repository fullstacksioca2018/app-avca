<div class="form-row">
  
        <input type="hidden" name="ninosbrazos" id="ninosbrazos2" value="0"> 

       <div class="col-md-6">
        <label for="exampleFormControlSelect1" class="h">Desde:</label>
        <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto" name="origen_id" id="origen_id_retorno" class="chosen-select impout3" class="form-control impout3" tabindex="2">
            <option value="#">Ciudad o aeropuerto</option>  
              @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
             <i class="fa fa-map-marker prefix icociudad2"></i>
          </div>  
        </div>  
  

<!-- JOooodeeerrr segundo select -->

  <div class="col-md-6">
        <label for="exampleFormControlSelect1" class="h">Hasta:</label>
        <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto" id="destino_id_retorno"  name="destino_id" class="chosen-select impout3" class="form-control impout3" tabindex="2">
            <option value="#">Ciudad o aeropuerto</option>              
              @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
             <i class="fa fa-map-marker prefix icociudad2"></i>
          </div>  
        </div>

    </div> <!-- fin de form-row -->

    <!-- Grd row -->

<!-- ======================
    FIN DEL DESDE
  ======================= -->

<!-- ======================
    INICIO DEL Calendario
  ======================= -->

 <div class="form-row">

    

<div class="col-md-4">            
            <label for="from" class="h">Fecha de ida:</label>           
            <input type="date" class="form-control impout3" id="fecha_salida2" name="fecha_salida" min="{{Carbon::now()->addDay(1)->format('Y-m-d')}}" max="{{Carbon::now()->addYear(1)->format('Y-m-d')}}>       
             <i class="fa fa-calendar prefix icocalendario"></i>
                 
        </div>

<div class="col-md-4">            
            <label for="to" class="h">fecha de regreso:</label>           
            <input type="date" class="form-control impout3" id="fecha_regreso" name="fecha_retorno" min="{{Carbon::now()->addDay()->format('Y-m-d')}}" max="{{Carbon::now()->addYear(1)->format('Y-m-d')}}>       
             <i class="fa fa-calendar prefix icocalendario"></i>                 
        </div>

  <script src="/online/js/FechaValidada.js" type="text/javascript"></script>

<div class="col col-md-1 col-lg-1">
       <label for="exampleFormControlSelect1" class="h">Adultos:</label>
        <div class="form-group">    
    <input type="number" id="inputadultos2" min="1" max="6" class="form-control" value="1" name="adultos" onchange="validarN('inputadultos','2')"> 
     </div>
      </div>
        
    <div class="col col-md-1 col-lg-1">
      <label for="exampleFormControlSelect1" class="h">Niños:</label>
      <div class="form-group">        
        <input type="number" id="inputninos2" min="0" max="5" class="form-control" value="0" name="ninos" onchange="validarN('inputninos','2')">
      </div>
    </div>

  </div>
  
{{-- ====================================== 
                Contador de personas
     ====================================== --}}
<div id="contenedorPersonas2">
</div>


  <div class="form-row">
    <input type="submit" value="BUSCAR" class="btn btn-primary">
  </div>
  