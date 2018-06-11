<?php

namespace App\Http\Controllers\Operativo;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

use DateTime;
use Illuminate\Http\Request;
use App\Models\operativo\Sucursal;
use App\Models\operativo\Ruta;
use App\Models\operativo\Vuelo;
use App\Models\operativo\Factura;
use App\Models\online\Tarjeta;
use App\Models\online\Boleto;
use App\Models\Operativo\Maleta;
use App\Models\Operativo\Asiento;

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;

use stdClass;

class FacturacionController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
        date_default_timezone_set('America/Caracas');
        $vuelos= new Vuelo();
        //busco todos los destinos programados de la fecha actual en adelante
        $actual = Carbon::now();
        $actual2=Carbon::now();
        $actual2->subHours(2); //agg 1hra para buscar y actualizar los vuelos que ya estan cerrados
        $vuelos->VuelosRetrasados($actual2->toDateTimeString());
        $actual2=Carbon::now();
        $actual2->subHours(6); 
        
        $vuelos->VuelosCerrados($actual2->toDateTimeString());
        // Disponibilidad de Boletos
        $vuelos->BoletosAgotados();
        $vuelos->BoletosDisponible();


       
    }
    
    public function factura(){
         
        return view('Operativo.Taquilla.Factura');
        
    } 

    public function facturas(){
        $facturas=Factura::porpagar();
        $datos=array();
       
        foreach($facturas as $factura){
            $obj= new stdClass();
            $fac=Factura::find($factura->factura_id);
            $boleto=Boleto::where('factura_id','=',$factura->factura_id)->get();
            $obj->id=$factura->factura_id;
            $obj->numero_factura=$fac->numero_factura;
            $obj->importe_facturado=$fac->importe_facturado;
            $obj->numero_control=$fac->numero_control;
            $obj->adultos_cant=$fac->adultos_cant;
            $obj->ninos_cant=$fac->ninos_cant;
            $obj->NinosBrazos_cant=$fac->NinosBrazos_cant;
            $obj->boletos=$boleto;
            $vuelos=Boleto::select('vuelo_id')->where('factura_id','=',$factura->factura_id)->GroupBy('vuelo_id')->get();
            $datosV=array();
            foreach($vuelos as $vuelo)
            {
                $objAux=Vuelo::find($vuelo)->first();
                $objAux->segmentos[0]->ruta->origen;
                $objAux->segmentos[0]->ruta->destino;
                array_push($datosV,$objAux);
            }
            $obj->vuelos=$datosV;
            array_push($datos,$obj);
        }
       // dd($datos);
        return $datos;
    }

    public function pagar (Request $data){
        if(isset($data['nombre'])){
            $tarjeta = new Tarjeta();
            $tarjeta->titular = $data['nombre'];
            $tarjeta->numero_tarjeta = $data['referencia'];
            $tarjeta->fecha_vencimiento = $data['tipo']." ".$data['tarjeta'];
            $tarjeta->save();
           }
            $boletos=Boleto::where('factura_id','=',$data['id'])->get();
            
           
           
          
            $factura =Factura::find($data['id']);   
             
            
            try {
                // Enter the share name for your USB printer here
                $connector = null;
                $connector = new WindowsPrintConnector("Tickera");
                /* Print a "Hello world" receipt" */
                $printer = new Printer($connector);
                $printer->feed();
                $printer -> text("*******************************\n"); 
                $printer -> text("     __      _______           \n");       
                $printer -> text("    /\ \    / / ____|   /\     \n");
                $printer -> text("   /  \ \  / / |       /  \    \n");
                $printer -> text("  / /\ \ \/ /| |      / /\ \   \n");
                $printer -> text(" / ____ \  / | |____ / ____ \  \n");
                $printer -> text("/_/    \_\/   \_____/_/    \_\ \n");
                $printer -> text("             SENIAT            \n");
                $printer -> text("          J-410124407          \n"); 
                $printer -> text("      ALAS DE VENEZUELA C.A    \n"); 
                $printer -> text("      Maiquetía 1162, Vargas   \n"); 
                $printer->feed();
                $printer -> text("            FACTURA          \n"); 
                $printer -> text("Factura:                ".$factura->numero_factura."\n"); 
                $printer -> text("Fecha: ".$factura->fecha." \n" );  
                $printer -> text("Hora: ".Carbon::now()->toTimeString()." \n");    
             
                $printer->feed();            
                $printer -> text("-------------------------------\n");  
                $printer->feed();
                $i = 1;
                foreach($boletos as $boleto){
                    $printer -> text("Boleto: [".$i."] \n");
                    $printer -> text("Identificacion: ".$boleto->documento." \n");
                    $printer -> text("Localizador: ".$boleto->localizador." \n");
                    $printer -> text("Nro Vuelo: ".$boleto->vuelo->n_vuelo." (".$boleto->vuelo->segmentos[0]->ruta->origen->sigla."-".$boleto->vuelo->segmentos[0]->ruta->destino->sigla.") \n");                
                    $printer -> text("Costo: ".$boleto->vuelo->segmentos[0]->ruta->tarifa_vuelo." BsS \n");
                    $printer -> text("-------------------------------\n");  
                 
                   // $boleto->boleto_estado="Pagado";               
                   // $boleto->save();
                    $i++;
                } 
                $printer -> text("Importe Facturado: ".$factura->importe_facturado." BsS \n");
                $printer -> text("     Gracias por su compra.   \n");
                $printer -> text("          Feliz Viaje          \n");
                 
                $printer->feed(); 
                $printer->feed(); 
                $printer->feed(); 
               
                $printer->feed(); 
                $printer -> cut();             
                /* Close printer */
                $printer -> close();
     
            } catch (Exception $e) {
                return  "Couldn't print to this printer: " . $e -> getMessage() . "\n";
            }
    
            return "Factura Pagada Correctamente";
    }
 
        //=====LLEGADA DE AVIONES===
    public function llegada()
    {
        //codigo de llegada
        return view('Operativo.Taquilla.LLegada');
    }

    public function llegadas()
    {
      $fecha=Carbon::now()->format('Y-m-d');
     //$fecha="2018-06-15";
     $vuelos=Vuelo::whereDate('fecha_salida','=',$fecha)->get(); 
     $datosV=array();
     foreach($vuelos as $objAux)
     {
         $objAux->segmentos[0]->ruta->origen;
         $objAux->segmentos[0]->ruta->destino;
         array_push($datosV,$objAux) ;
     }
    return $datosV;
    }
    
    public function llego(Request $data){
        $datos=json_decode($data['datos']);
        $vuelo=Vuelo::find($datos->id);
        $fecha=Carbon::now()->format('Y-m-d');
        $vuelo->fecha_llegada=$fecha." ".$datos->HH.":".$datos->mm.":".$datos->ss;
        $vuelo->observaciones=$datos->area;
        $vuelo->estado='finalizado';
        $vuelo->save();
        return "ok";
        //$vuelo->fecha
    }

}
?>