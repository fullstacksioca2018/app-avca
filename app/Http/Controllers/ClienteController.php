<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sucursal;
use App\Vuelo;
use App\Ruta;
use App\Boleto;
use App\Factura;
use App\Tarjeta;
use App\User;
use DB;
use Carbon\Carbon;
use DateTime;
use stdClass;
use Auth;

class ClienteController extends Controller
{
    public function index1()
    {
        $sucursales = Sucursal::orderBy('ciudad','ASC')->get();
    	return view('cliente.componentes.inicio', compact('sucursales'));
    
    }

    public function index2()
    {

        $sucursales = Sucursal::orderBy('ciudad','ASC')->get();
        return view('cliente.componentes.retorno', compact('sucursales'));
    
    }

    public function index3()
    {

        $sucursales = Sucursal::orderBy('ciudad','ASC')->get();
        return view('cliente.componentes.multidestino', compact('sucursales'));
    
    }

    public function DetalleVuelo(Request $request)
    {
       // dd($request->all());
        $date = new DateTime($request->get('fecha_salida'));
        $rutas = Ruta::Rutas($request->get('origen_id'),$request->get('destino_id'),$date);

        $c1= $request->get('ninos');
        $c2= $request->get('adultos');
        $c3= $request->get('ninosbrazos');

        $vuelos= array();
        $vueloAux;
        $segmentos;
        $origen;
        $destino;
        $cantidad_personas= $c1 + $c2;
        foreach ($rutas as $vueloID) {
            $vueloAux=Vuelo::find($vueloID->id);
            $segmentos=$vueloAux->segmentos;
            if(count($segmentos)==1){
                $ruta=$segmentos[0]->ruta;
                $origen=$segmentos[0]->ruta->origen;
                $destino=$segmentos[0]->ruta->destino;
            }else{
                foreach ($segmentos as $segmento) {
                   dd("varios segmentos");
                }
            }
            $objAUX= new stdClass();
            $objAUX->vuelo=$vueloAux;
            $objAUX->ruta=$ruta;
            $objAUX->origen=$origen;
            $objAUX->destino=$destino;
            $objAUX->cantidad=$cantidad_personas;
            $objAUX->ninosbrazos=$c3;
            array_push($vuelos, $objAUX);
        }

        if(count($vuelos)){
                return view('cliente.componentes.DetalleVuelo')->with('vuelos',$vuelos);
        }else{

                return redirect()->route('cliente.index1');
        }

    }

    

    public function equipaje()
    {
    	
    	return view('cliente.componentes.equipaje');

    }

    public function documentacion()
    {
    	
    	return view('cliente.componentes.documentacion');

    }

    public function CompraBoleto($cantidad,$ninosbrazos,$tarifa_vuelo)
    {
    	
    	return view('cliente.componentes.CompraBoleto',compact('cantidad','ninosbrazos','tarifa_vuelo'));

    }

    public function CompraBoleto2($cantidad,$ninosbrazos,$tarifa_vuelo,$vuelo)
    {
        return view('cliente.componentes.CompraBoleto',compact('cantidad','ninosbrazos','tarifa_vuelo','vuelo'));

    }

    public function BoletoVendido(Request $request)
    {

         // SAVE DATOS DE TARJETA

         $tarjeta = new Tarjeta($request->all());
         $tarjeta->titular = $request->usernam;
         $tarjeta->numero_tarjeta = $request->numero_tarjeta;
         $tarjeta->fecha_vencimiento = $request->fecha_vencimiento;
         $tarjeta->save();

         // // SAVE DATOS DE FACTURAS

         $factura = new Factura($request->all());
         $factura->numero_factura = 'FA-'.random_int(10000, 99999);
         $factura->fecha = Carbon::now();
         $factura->importe_facturado = $request->importe_facturado;
         $factura->numero_control = 'N°'.'00-'.random_int(100000, 999999);
         $factura->adultos_cant = $request->adulto;
         $factura->ninos_cant = $request->nino;
         $factura->NinosBrazos_cant = $request->brazo;
         $factura->tarjeta_id = $tarjeta->id;
         $factura->save();
         // SAVE DATOS DE BOLETOS
         // dd(count($request->primerNombre));
        $user = Auth::user();
        $date = Carbon::now()->addYear(); //2015-01-01 00:00:00
       // dd($request->all());
        for($key = 0; $key < count($request->primerNombre); $key++){
            $Nboleto = new Boleto();
            $Nboleto->boleto_estado="Pagado";
            $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
            if($request->tipo_boleto[$key]=="adulto")
                $Nboleto->asiento=$request->asiento[$key];
            else{
                $Nboleto->asiento="null";
            }
            $Nboleto->primerNombre=$request->primerNombre[$key];
            $Nboleto->segundoNombre = $request->segundoNombre[$key];
            $Nboleto->tipo_documento=$request->tipo_documento[$key];
            $Nboleto->documento=$request->documento[$key];
            $Nboleto->genero=$request->genero[$key]; 
            $Nboleto->apellido=$request->apellido[$key]; 
            $Nboleto->tipo_boleto=$request->tipo_boleto[$key];
            $Nboleto->fecha_nacimiento=$request->fecha_nacimiento[$key];
            if($request->tipo_boleto[$key]=="bebe en brazos")
                $Nboleto->detalles_salud="null";
            else{
                $Nboleto->detalles_salud=$request->detalles_salud[$key];
            }

            $Nboleto->user_id=$user->id;
            $Nboleto->factura_id=$factura->id;
            $Nboleto->vuelo_id=$request->vuelo;
            $Nboleto->save();

        }    
        return view('cliente.componentes.BoletoVendido');  

    }


    public function BoletoVendido2(Request $request)
    {

        //dd($request->all());

         // SAVE DATOS DE TARJETA

         $tarjeta = new Tarjeta($request->all());
         $tarjeta->titular = $request->usernam;
         $tarjeta->numero_tarjeta = $request->numero_tarjeta;
         $tarjeta->fecha_vencimiento = $request->fecha_vencimiento;
         $tarjeta->save();

         // // SAVE DATOS DE FACTURAS
        if(!isset($request->vuelta)){
             $factura = new Factura($request->all());
             $factura->numero_factura = 'FA-'.random_int(10000, 99999);
             $factura->fecha = Carbon::now();
             $factura->importe_facturado = $request->importe_facturado;
             $factura->numero_control = 'N°'.'00-'.random_int(100000, 999999);
             $factura->adultos_cant = $request->adulto;
             $factura->ninos_cant = $request->nino;
             $factura->NinosBrazos_cant = $request->brazo;
             $factura->tarjeta_id = $tarjeta->id;
             $factura->save();
             // SAVE DATOS DE BOLETOS
             // dd(count($request->primerNombre));
            $user = Auth::user();
            $date = Carbon::now()->addYear(); //2015-01-01 00:00:00
           // dd($request->all());
                for($key = 0; $key < count($request->primerNombre); $key++){
                    $Nboleto = new Boleto();
                    $Nboleto->boleto_estado="Pagado";
                    $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                    if($request->tipo_boleto[$key]=="adulto")
                        $Nboleto->asiento=$request->asiento[$key];
                    else{
                        $Nboleto->asiento="null";
                    }
                    $Nboleto->primerNombre=$request->primerNombre[$key];
                    $Nboleto->segundoNombre = $request->segundoNombre[$key];
                    $Nboleto->documento=$request->documento[$key];
                    $Nboleto->genero=$request->genero[$key]; 
                    $Nboleto->apellido=$request->apellido[$key]; 
                    $Nboleto->tipo_boleto=$request->tipo_boleto[$key];
                    $Nboleto->fecha_nacimiento=$request->fecha_nacimiento[$key];
                    if($request->tipo_boleto[$key]=="bebe en brazos")
                        $Nboleto->detalles_salud="null";
                    else{
                        $Nboleto->detalles_salud=$request->detalles_salud[$key];
                    }

                    $Nboleto->user_id=$user->id;
                    $Nboleto->factura_id=$factura->id;
                    $Nboleto->vuelo_id=$request->vuelo;
                    $Nboleto->save();

                }    
        
        }
        
        else{
            $factura = new Factura($request->all());
             $factura->numero_factura = 'FA-'.random_int(10000, 99999);
             $factura->fecha = Carbon::now();
             $factura->importe_facturado = $request->importe_facturado;
             $factura->numero_control = 'N°'.'00-'.random_int(100000, 999999);
             $factura->adultos_cant = $request->adulto;
             $factura->ninos_cant = $request->nino;
             $factura->NinosBrazos_cant = $request->brazo;
             $factura->tarjeta_id = $tarjeta->id;
             $factura->save();

             $vuelos= array();

             array_push($vuelos, $request->vuelo);
             array_push($vuelos, $request->vuelta);
             
             $user = Auth::user();
             $date = Carbon::now()->addYear(); //2015-01-01 00:00:00

             foreach ($vuelos as $idvuelo) {
                 
                for($key = 0; $key < count($request->primerNombre); $key++){
                    $Nboleto = new Boleto();
                    $Nboleto->boleto_estado="Pagado";
                    $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                    if($request->tipo_boleto[$key]=="adulto")
                        $Nboleto->asiento=$request->asiento[$key];
                    else{
                        $Nboleto->asiento="null";
                    }
                    $Nboleto->primerNombre=$request->primerNombre[$key];
                    $Nboleto->segundoNombre = $request->segundoNombre[$key];
                    $Nboleto->documento=$request->documento[$key];
                    $Nboleto->genero=$request->genero[$key]; 
                    $Nboleto->apellido=$request->apellido[$key]; 
                    $Nboleto->tipo_boleto=$request->tipo_boleto[$key];
                    $Nboleto->fecha_nacimiento=$request->fecha_nacimiento[$key];
                    if($request->tipo_boleto[$key]=="bebe en brazos")
                        $Nboleto->detalles_salud="null";
                    else{
                        $Nboleto->detalles_salud=$request->detalles_salud[$key];
                    }

                    $Nboleto->user_id=$user->id;
                    $Nboleto->factura_id=$factura->id;
                    $Nboleto->vuelo_id=$idvuelo;
                    $Nboleto->save();

                }
             }
           // dd($request->all());

        }
        return view('cliente.componentes.BoletoVendidoRetorno');  

    }

    public function DetalleRetorno2($cantidad,$ninosbrazos,$tarifa_vuelo,$vuelo,$retorno){
        $vuelo=Vuelo::find($vuelo);
        $segmentos=$vuelo->segmentos;
        if(count($segmentos)==1){
            $ruta=$segmentos[0]->ruta;
            $origen=$segmentos[0]->ruta->origen;
            $destino=$segmentos[0]->ruta->destino;
        }else{
            foreach ($segmentos as $segmento) {
               dd("varios segmentos");
            }
        }

        $anterior= new stdClass();
        $anterior->vuelo=$vuelo;
        $anterior->ruta=$ruta;
        $anterior->origen=$origen;
        $anterior->destino=$destino;

        $date = new DateTime($retorno);
        $rutas = Ruta::Rutas($destino->id,$origen->id,$date);
        $vuelos= array();
         foreach ($rutas as $vueloID) {
            $vueloAux=Vuelo::find($vueloID->id);
            $segmentos=$vueloAux->segmentos;
            if(count($segmentos)==1){
                $ruta=$segmentos[0]->ruta;
                $origen=$segmentos[0]->ruta->origen;
                $destino=$segmentos[0]->ruta->destino;
            }else{
                foreach ($segmentos as $segmento) {
                   dd("varios segmentos");
                }
            }
            $objAUX= new stdClass();
            $objAUX->vuelo=$vueloAux;
            $objAUX->ruta=$ruta;
            $objAUX->origen=$origen;
            $objAUX->destino=$destino;
            $objAUX->cantidad=$cantidad;
            $objAUX->ninosbrazos=$ninosbrazos;
            array_push($vuelos, $objAUX);
        }
        // dd($vuelos);

        if(count($vuelos)){
                return view('cliente.componentes.DetalleRetorno')->with('vuelos',$vuelos)->with('ida',$anterior);
        }else{

                return redirect()->route('cliente.index1');
        }
    }

    public function DetalleRetorno(Request $request)
    {
        // dd($request->all());
        $date = new DateTime($request->get('fecha_salida'));
        $rutas = Ruta::Rutas($request->get('origen_id'),$request->get('destino_id'),$date);

        $c1= $request->get('ninos');
        $c2= $request->get('adultos');
        $c3= $request->get('ninosbrazos');

        $vuelos= array();
        $vueloAux;
        $segmentos;
        $origen;
        $destino;
        $cantidad_personas= $c1 + $c2;
        foreach ($rutas as $vueloID) {
            $vueloAux=Vuelo::find($vueloID->id);
            $segmentos=$vueloAux->segmentos;
            if(count($segmentos)==1){
                $ruta=$segmentos[0]->ruta;
                $origen=$segmentos[0]->ruta->origen;
                $destino=$segmentos[0]->ruta->destino;
            }else{
                foreach ($segmentos as $segmento) {
                   dd("varios segmentos");
                }
            }
            $objAUX= new stdClass();
            $objAUX->vuelo=$vueloAux;
            $objAUX->ruta=$ruta;
            $objAUX->origen=$origen;
            $objAUX->destino=$destino;
            $objAUX->cantidad=$cantidad_personas;
            $objAUX->ninosbrazos=$c3;
            array_push($vuelos, $objAUX);
        }

        if(count($vuelos)){
                return view('cliente.componentes.DetalleVuelo')->with('vuelos',$vuelos)->with('retorno',$request->get('fecha_retorno'));
        }else{
                return redirect()->route('cliente.index1');
        }
    }

    public function DetalleMultidestino(Request $request)
    {

        // dd($request->all());

        $objMultidestinos= new stdClass();
        $objMultidestinos->origenes=$request->origen_id;
        $objMultidestinos->destinos=$request->destino_id;
        $objMultidestinos->fechas=$request->fecha_salida;
        $objMultidestinos->ninos=$request->ninos;
        $objMultidestinos->adultos=$request->adultos;
        $objMultidestinos->ninosbrazos=$request->ninosbrazos;

        $date = new DateTime($objMultidestinos->fechas[0]);
        $rutas = Ruta::Rutas($objMultidestinos->origenes[0],$objMultidestinos->destinos[0],$date);

        $c1= $objMultidestinos->ninos;
        $c2= $objMultidestinos->adultos;
        $c3= $objMultidestinos->ninosbrazos;

        $vuelos= array();
        $vueloAux;
        $segmentos;
        $origen;
        $destino;
        $cantidad_personas= $c1 + $c2;
        foreach ($rutas as $vueloID) {
            $vueloAux=Vuelo::find($vueloID->id);
            $segmentos=$vueloAux->segmentos;
            if(count($segmentos)==1){
                $ruta=$segmentos[0]->ruta;
                $origen=$segmentos[0]->ruta->origen;
                $destino=$segmentos[0]->ruta->destino;
            }else{
                foreach ($segmentos as $segmento) {
                   dd("varios segmentos");
                }
            }
            $objAUX= new stdClass();
            $objAUX->vuelo=$vueloAux;
            $objAUX->ruta=$ruta;
            $objAUX->origen=$origen;
            $objAUX->destino=$destino;
            $objAUX->cantidad=$cantidad_personas;
            $objAUX->ninosbrazos=$c3;
            array_push($vuelos, $objAUX);
        }

        if(count($vuelos)){
                return view('cliente.componentes.DetalleVuelo')->with('vuelos',$vuelos)->with('objMultidestinos',$objMultidestinos);
        }else{

                return redirect()->route('cliente.index1');
        }

        // dd($request->all());

    }

    public function DetalleMultidestino2(Request $request){
        $objMultidestinos= new stdClass();
        $objMultidestinos->origenes=$request->origenes;
        $objMultidestinos->destinos=$request->destinos;
        $objMultidestinos->fechas=$request->fechas;
        $objMultidestinos->ninos=$request->ninos;
        $objMultidestinos->adultos=$request->adultos;
        $objMultidestinos->ninosbrazos=$request->ninosbrazos;
        $objMultidestinos->cantidad=$request->cantidad;
        $cantidad=$request->cantidad;
        $ninosbrazos=$request->ninosbrazos;
        $objMultidestinos->seleccionados= array();
        if(isset($request->seleccionados)){
            //agg todos los vuelos antes seleccionado
            for($i=0;$i<(count($request->seleccionados));$i++){
                $vuelo=Vuelo::find($request->seleccionados[$i]);
                $segmentos=$vuelo->segmentos;
                if(count($segmentos)==1){
                    $ruta=$segmentos[0]->ruta;
                    $origen=$segmentos[0]->ruta->origen;
                    $destino=$segmentos[0]->ruta->destino;
                }else{
                    foreach ($segmentos as $segmento) {
                       dd("varios segmentos");
                    }
                }

                $seleccion= new stdClass();
                $seleccion->vuelo=$vuelo;
                $seleccion->ruta=$ruta;
                $seleccion->origen=$origen;
                $seleccion->destino=$destino;

                array_push($objMultidestinos->seleccionados, $seleccion);
            }
            //agg el nuevo vuelo seleccionado
            $vuelo=Vuelo::find($request->vuelo);
            $segmentos=$vuelo->segmentos;
            if(count($segmentos)==1){
                $ruta=$segmentos[0]->ruta;
                $origen=$segmentos[0]->ruta->origen;
                $destino=$segmentos[0]->ruta->destino;
            }else{
                foreach ($segmentos as $segmento) {
                   dd("varios segmentos");
                }
            }

            $anterior= new stdClass();
            $anterior->vuelo=$vuelo;
            $anterior->ruta=$ruta;
            $anterior->origen=$origen;
            $anterior->destino=$destino;

            array_push($objMultidestinos->seleccionados, $anterior);


            if((count($objMultidestinos->seleccionados))==(count($objMultidestinos->origenes))){
                    return view('cliente.componentes.CompraBoleto',compact('cantidad','ninosbrazos','tarifa_vuelo','objMultidestinos'));
            }
            else{
                //busco los vuelos para la siguinte selección
                $date = new DateTime($objMultidestinos->fechas[(count($request->seleccionados)+1)]);
                $rutas = Ruta::Rutas($objMultidestinos->origenes[(count($request->seleccionados)+1)],$objMultidestinos->destinos[(count($request->seleccionados)+1)],$date);
                $vuelos= array();
                 foreach ($rutas as $vueloID) {
                    $vueloAux=Vuelo::find($vueloID->id);
                    $segmentos=$vueloAux->segmentos;
                    if(count($segmentos)==1){
                        $ruta=$segmentos[0]->ruta;
                        $origen=$segmentos[0]->ruta->origen;
                        $destino=$segmentos[0]->ruta->destino;
                    }else{
                        foreach ($segmentos as $segmento) {
                           dd("varios segmentos");
                        }
                    }
                    $objAUX= new stdClass();
                    $objAUX->vuelo=$vueloAux;
                    $objAUX->ruta=$ruta;
                    $objAUX->origen=$origen;
                    $objAUX->destino=$destino;
                    $objAUX->cantidad=$objMultidestinos->cantidad;
                    $objAUX->ninosbrazos=$objMultidestinos->ninosbrazos;
                    array_push($vuelos, $objAUX);
                }
                if(count($vuelos)){
                        return view('cliente.componentes.DetalleMultidestino')->with('vuelos',$vuelos)->with('objMultidestinos',$objMultidestinos);
                }else{

                        return redirect()->route('cliente.index1');
                } 
            }

        }
        else{
            $vuelo=Vuelo::find($request->vuelo);
            $segmentos=$vuelo->segmentos;
            if(count($segmentos)==1){
                $ruta=$segmentos[0]->ruta;
                $origen=$segmentos[0]->ruta->origen;
                $destino=$segmentos[0]->ruta->destino;
            }else{
                foreach ($segmentos as $segmento) {
                   dd("varios segmentos");
                }
            }

            $anterior= new stdClass();
            $anterior->vuelo=$vuelo;
            $anterior->ruta=$ruta;
            $anterior->origen=$origen;
            $anterior->destino=$destino;

            $objMultidestinos->seleccionados= array();
            array_push($objMultidestinos->seleccionados, $anterior);

            $date = new DateTime($objMultidestinos->fechas[1]);
            $rutas = Ruta::Rutas($objMultidestinos->origenes[1],$objMultidestinos->destinos[1],$date);
            $vuelos= array();
             foreach ($rutas as $vueloID) {
                $vueloAux=Vuelo::find($vueloID->id);
                $segmentos=$vueloAux->segmentos;
                if(count($segmentos)==1){
                    $ruta=$segmentos[0]->ruta;
                    $origen=$segmentos[0]->ruta->origen;
                    $destino=$segmentos[0]->ruta->destino;
                }else{
                    foreach ($segmentos as $segmento) {
                       dd("varios segmentos");
                    }
                }
                $objAUX= new stdClass();
                $objAUX->vuelo=$vueloAux;
                $objAUX->ruta=$ruta;
                $objAUX->origen=$origen;
                $objAUX->destino=$destino;
                $objAUX->cantidad=$objMultidestinos->cantidad;
                $objAUX->ninosbrazos=$objMultidestinos->ninosbrazos;
                array_push($vuelos, $objAUX);
            }
            // dd($vuelos);

            if(count($vuelos)){
                    return view('cliente.componentes.DetalleMultidestino')->with('vuelos',$vuelos)->with('objMultidestinos',$objMultidestinos);
            }else{

                    return redirect()->route('cliente.index1');
            }
           
            
        }
        // dd($request->all());

    }


}
