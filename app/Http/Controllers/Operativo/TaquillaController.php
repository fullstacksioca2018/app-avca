<?php

namespace App\Http\Controllers\Operativo;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

use DateTime;
use Illuminate\Http\Request;
use App\Models\operativo\Sucursal;
use App\Models\operativo\Ruta;
use App\Models\operativo\Vuelo;
use App\Models\online\Factura;
use App\Models\online\Tarjeta;
use App\Models\online\Boleto;
use stdClass;

class TaquillaController extends Controller
{
	public function __construct(){
		Carbon::setLocale('es');
		date_default_timezone_set('America/Caracas');
	}

    public function taquilla(){
    	$sucursales = Sucursal::orderBy('ciudad','ASC')->get();
		//dd($sucursal);
		return view('Operativo.Taquilla.Taquilla',compact('sucursales'));
		
    }

    public function DetalleVuelo(Request $request)
    {
        //dd($request->all());return;
        $date = new DateTime($request->get('fecha_salida'));
        $rutas = Ruta::Rutas($request->get('origen_id'),$request->get('destino_id'),$date);

        $c1= $request->get('ninos');
        $c2= $request->get('adultos');
		$c3= $request->get('ninosbrazos');
		/* dd($date,$rutas,$c1,$c2,$c3);
		return; */
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
                return view('Operativo.Taquilla.Compra.DetalleVuelo')->with('vuelos',$vuelos);
        }else{

			   ?>
			   <script>
				   alert("FATAL ERROR - REINICIANDO SISTEMA -- SYSTEM OUT ");
			   </script> 
			   <?php  
			  // return view('Operativo.Taquilla.Taquilla')->name('ida');
			  dd($vuelos->ruta);
        }

    }

    public function CompraBoleto($cantidad,$ninosbrazos,$tarifa_vuelo)
    {
        
        return view('Operativo.Taquilla.Compra.CompraBoleto',compact('cantidad','ninosbrazos','tarifa_vuelo'));

    }

    public function BoletoVendido(Request $request)
    {
         //para resumen
         $boletos = array();
         $datos_vuelos = array();   
         $rutas = array();

         // SAVE DATOS DE TARJETA
         $tarjeta = new Tarjeta($request->all());
         dd($request->all());
         $tarjeta->titular = $request->usernam;
         $tarjeta->numero_tarjeta = $request->numero_tarjeta;
         $tarjeta->fecha_vencimiento = $request->fecha_vencimiento;
         $tarjeta->save();

         // // SAVE DATOS DE FACTURAS

         $factura = new Factura();
         $factura->numero_factura = 'FA-'.random_int(10000, 99999);
         $factura->fecha = Carbon::now();
         $factura->importe_facturado = $request->importe_facturado;
         $factura->numero_control = 'N°'.'00-'.random_int(100000, 999999);
        // dd($request->adulto,$request->nino,$request->brazo);
         $factura->adultos_cant = $request->adulto;
         $factura->ninos_cant = $request->nino;
         $factura->NinosBrazos_cant = $request->brazo;
         $factura->tarjeta_id = $tarjeta->id;
         $factura->save();
         
         // SAVE DATOS DE BOLETOS
         // dd(count($request->primerNombre));
        $user = Auth::guard('online')->user();
        $date = Carbon::now()->addYear(); //2015-01-01 00:00:00
       // dd($request->all());
        

        if(isset($request->vuelos)){ //multidestino
            for($i = 0; $i < count($request->vuelos); $i++){
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
                    $Nboleto->tipo_documento = $request->tipo_documento[$key];
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
                    $Nboleto->vuelo_id=$request->vuelos[$i];
                    $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                    $Nboleto->save();
                    
                    array_push($boletos, $Nboleto);    

                }
                $vueloAux = Vuelo::find($request->vuelos[$i]);
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
                array_push($datos_vuelos, $objAUX);
            }
        }
        else{ //un solo destino
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
                $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                $Nboleto->save();
                array_push($boletos, $Nboleto);    
                

            }
            $AuxVuelo = Vuelo::find($request->vuelo);
            $segmentos=$AuxVuelo->segmentos;
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
            $objAUX->vuelo=$AuxVuelo;
            $objAUX->ruta=$ruta;
            $objAUX->origen=$origen;
            $objAUX->destino=$destino;
            array_push($datos_vuelos, $objAUX);
        }

        // ENVIO DE EMAIL
       // Mail::to(Auth::guard('online')->user()->email)->send(new CompraBoleto($boletos, Auth::guard('online')->user(), $datos_vuelos, $factura));


        return view('Operativo.Taquilla.Compra.BoletoVendido')->with('datos_vuelos',$datos_vuelos)->with('boletos',$boletos)->with('factura', $factura)->with('rutas',$rutas);  

    }

}
