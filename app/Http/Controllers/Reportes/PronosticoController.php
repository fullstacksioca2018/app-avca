<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use stdClass;
use App\Models\reporte\DW_Ingreso;
use App\Models\reporte\DW_Ruta;

class PronosticoController extends Controller
{
	public function PROMEDIOMOVILDOBLE(){
        $inicio="01-01-2017";
        $final="31-12-2017";
        $meses=[1,2,3,4,5,6,7,8,9,10,11,12];
        $ingresos=DW_Ingreso::IngresosFechaMes($meses,"2017");
        // dd($ingresos);
        $PMS=array(); //Promedio movil simple
        //Los Primeros Indixes son indefinidos
        array_push($PMS, "0"); 
        array_push($PMS, "0");

        $error=0; //ERROR
        $indice=999; //posición
        $ingresos[10]->total=900;
// dd($ingresos[10]->total);
        for ($i=2; $i < count($ingresos); $i++) { 
            $acumulador=0;
            for ($j=0; $j < $i; $j++) { 
                $acumulador=$acumulador+$ingresos[$j]->total;
            }
            array_push($PMS, ($acumulador/$i));

            if($error!=0){
                if($error>($PMS[$i]-$ingresos[$i]->total)){
                    if(($PMS[$i]-$ingresos[$i]->total)<0){
                        $aux_Error=-1*($PMS[$i]-$ingresos[$i]->total);
                        if($error>$aux_Error){
                            $error=$aux_Error;
                            $indice=$i;
                        }
                    }
                    else{
                        $error=$PMS[$i]-$ingresos[$i]->total;
                        $indice=$i;
                    }
                }
            }
            else{
                if(($PMS[$i]-$ingresos[$i]->total)<0){
                    $aux_Error=-1*($PMS[$i]-$ingresos[$i]->total);
                    if($error>$aux_Error){
                        $error=$aux_Error;
                        $indice=$i;
                    }
                }
                else{
                    $error=$PMS[$i]-$ingresos[$i]->total;
                    $indice=$i;
                }
            }
        }

        $PMD; //Promedio movil doble
        $acumulador=0;
        for ($j=2; $j < $indice; $j++) { 
            $acumulador=$acumulador+$PMS[$j];
        }
        if(($indice-2)<1){
            $PMD=$acumulador;
        }
        else{
            $PMD=$acumulador/($indice-2);
        }
        $a = (2*$PMS[$indice])-$PMD;
        $b = (count($ingresos)/(count($ingresos)-1))*($PMS[$indice]-$PMD);

        if($b<0)
            $b=$b*-1;

        $obj =new stdClass();
        $obj->labels= array();
        $obj->data= array();
        
        $resultados=array();
        for ($i=1; $i < 13; $i++) { 
            array_push($obj->labels, $this->mes($i));
            array_push($obj->data, ($a+($b*$i)));
        }
        return response()->json($obj);

    }   
    public function mes($numero){
        switch ($numero) {
            case '1':
                return "Enero";
                break;
            case '2':
                return "Febrero";
                break;
            case '3':
                return "Marzo";
                break;
            case '4':
                return "Abril";
                break;
            case '5':
                return "Mayo";
                break;
            case '6':
                return "Junio";
                break;
            case '7':
                return "Julio";
                break;
            case '8':
                return "Agosto";
                break;
            case '9':
                return "Septiembre";
                break;
            case '10':
                return "Octubre";
                break;
            case '11':
                return "Noviembre";
                break;
            case '12':
                return "Diciembre";
                break;
        }
    }
}
