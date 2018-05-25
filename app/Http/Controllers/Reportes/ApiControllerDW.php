<?php

namespace App\Http\Controllers\Reportes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use stdClass;
use App\Models\reporte\DW_Ingreso;
use App\Models\reporte\DW_Ruta;

class ApiControllerDW extends Controller
{
    public function listCargos()
    {
        $cargos = DB::table('cargos')
            ->join('tabuladores_salariales', 'cargos.tabulador_salarial_id', '=', 'tabuladores_salariales.tabulador_salarial_id')
            ->join('areas', 'cargos.area_id', '=', 'areas.area_id')
            ->select('tabuladores_salariales.sueldo_base', 'areas.nombre', 'cargos.*')
            ->get();
        return response()->json($cargos);
    }

    public function listRutas()
    {
        $rutas=DW_Ruta::orderBy('ruta_id')->get();
        $arrayRutas=array();
        $siglas=array();
        foreach ($rutas as $ruta) {
            $sigla=$ruta->ruta_id.'. '.$ruta->origen->sigla.'-'.$ruta->destino->sigla;
            array_push($siglas, $sigla);
        }

        return response()->json($siglas);
    }

    public function reporteIngresos(Request $consulta){
        // dd($consulta->all());
        $ingresos=DW_Ingreso::IngresosFecha($consulta->inicio,$consulta->final);
        $obj =new stdClass();
        $obj->labels= array();
        $obj->data= array();
        Carbon::setLocale(LC_TIME, 'Spanish');
        foreach ($ingresos as $ingreso) {
            $carboAux=Carbon::parse($ingreso->fecha_ingreso);
            array_push($obj->data, $ingreso->total);
            array_push($obj->labels, $carboAux->formatLocalized('%d %B'));
        }
        return response()->json($obj);
    }

    public function PROMEDIOMOVILDOBLE(){
        $inicio="01-01-2017";
        $final="31-12-2017";
        $meses=[1,2,3,4,5,6,7,8,9,10,11,12];
        $ingresos=DW_Ingreso::IngresosFechaMes($meses,"2017");

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



    //Error minimo



    /*
    PMS=muestra/numero de muestras
     < (D-P)2 El error minimo



	a = 2(PMS) – PMD
	a = 2 (37.50) – 30 = 45
	a = 45
	b = n/n-1 (PMS – PMD)
	b = 15
	Paso 5
	ynov = a + b(x) = 45+ 15(2) = 75 unidades
	ydic = a + b(x) = 45+ 15(3) = 90 unidades
	yene = a + b(x) = 45+ 15(4) = 105 unidades

     */
    
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

    public function reportes(Request $consulta){
        return response()->json($consulta->all());
        // dd($consulta->all());
    /*
    PARAMETROS
    graficas
    consulta
    parametros 
    datosf
    filtros
    filtrosP
     */
       /* $titulo="";
        $grafico="";
        $datos;
        $label=array();
        $data=array();
        $stack=array();
        this.graficas=array();
        if(this.form.parametros.length){
            switch (this.form.consulta) {
                case "Personal":
                    $barras=array();
                    $datosbarra=array();
                    $inferior=array();
                    if(this.form.parametros.length>=1){
                        if(this.form.parametros.length==1&&((this.form.datosf["Sucursal"]&&this.form.datosf["Sucursal"].length==1&&this.form.datosf["Cargo"]&&this.form.datosf["Cargo"].length==1)||(!this.form.datosf["Sucursal"]&&this.form.datosf["Cargo"]&&this.form.datosf["Cargo"].length==1))||(!this.form.datosf["Sucursal"]&&!this.form.datosf["Cargo"])){
                            grafico="Torta";
                            barras[0]="";
                            titulo=titulo+this.form.parametros[0];
                            if(this.form.parametros.length==1){
                                if(!this.form.datosf["Sucursal"]&&!this.form.datosf["Cargo"]){
                                    inferior.push(this.form.parametros[0]);
                                }else{
                                    if(this.form.datosf["Sucursal"]){
                                        if(this.form.datosf["Cargo"])
                                            inferior.push(this.form.parametros[0]+", Suc. "+this.form.datosf["Sucursal"][0]+" "+this.form.datosf["Cargo"][0]);
                                        inferior.push(this.form.parametros[0]+", Suc. "+this.form.datosf["Sucursal"][0]);
                                    }
                                    else{
                                        inferior.push(this.form.parametros[0]+" "+this.form.datosf["Cargo"][0]);
                                    }
                                }
                                inferior.push("otro");
                                $auxAle=this.aleatorio();
                                datosbarra=[auxAle,(100-auxAle)];
                            }
                            else{
                                $auxT=0;
                                for ($i = 0; i < this.form.parametros.length; i++) {
                                    $auxAle=((100/this.form.parametros.length)*this.aleatorio())/100;
                                    datosbarra.push(auxAle);
                                    auxT+=auxAle;
                                    if(!this.form.datosf["Sucursal"]&&!this.form.datosf["Cargo"]){
                                        inferior.push(this.form.parametros[i]);
                                    }else{
                                        if(this.form.datosf["Sucursal"]){
                                            if(this.form.datosf["Cargo"])
                                                inferior.push(this.form.parametros[i]+", Suc. "+this.form.datosf["Sucursal"][0]+" "+this.form.datosf["Cargo"][0]);
                                            inferior.push(this.form.parametros[i]+", Suc. "+this.form.datosf["Sucursal"][0]);
                                        }
                                        else{
                                            inferior.push(this.form.parametros[i]+" "+this.form.datosf["Cargo"][0]);
                                        }
                                    }
                                }
                                if(this.form.parametros.length==4)
                                    datosbarra[0]+=(100-auxT);
                                else{
                                    inferior.push("otro");
                                    datosbarra.push((100-auxT));
                                }
                            }
                        }
                        else{
                            grafico="Bar";
                            inferior=['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'];
                            for ($i = 0; i < this.form.parametros.length; i++) {
                                if(titulo=='')
                                    titulo=this.form.parametros[i];
                                else
                                    titulo=titulo+", "+this.form.parametros[i];
                                if(this.form.datosf["Sucursal"]){
                                    for ($j = 0; j < this.form.datosf["Sucursal"].length; j++) {
                                        if(this.form.datosf["Cargo"]){
                                            for ($k = 0; k < this.form.datosf["Cargo"].length; k++) {
                                                barras.push(this.form.parametros[i]+": Suc. "+this.form.datosf["Sucursal"][j]+", "+this.form.datosf["Cargo"][k]);
                                                datosbarra.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
                                            }
                                        }else{
                                            barras.push(this.form.parametros[i]+": Suc. "+this.form.datosf["Sucursal"][j]);
                                            datosbarra.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
                                        }
                                    }
                                }
                                else{
                                    if(this.form.datosf["Cargo"]){
                                        for ($k = 0; k < this.form.datosf["Cargo"].length; k++) {
                                                barras.push(this.form.parametros[i]+", "+this.form.datosf["Cargo"][k]);
                                                datosbarra.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
                                        }
                                    }else{
                                        barras.push(this.form.parametros[i]);
                                        datosbarra.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
                                    }
                                }
                            }
                        }
                        datos={labels:inferior,label:barras,data:datosbarra}
                        this.graficas.push({
                            "titulo":titulo.toUpperCase(),
                            "grafica":grafico,
                            "datos":datos
                        });
                    }
                    break;
                case "Ingresos":
                        $label=array();
                        $data=array();
                        $inferior=['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'];
                        label=array();
                        data=array();
                    for ($i = 0; i < this.form.parametros.length; i++) {
                        for ($j = 0; j < this.form.filtros.length; j++) {
                            if(this.form.datosf[this.form.filtros[j]]){
                                for ($k = 0; k < this.form.datosf[this.form.filtros[j]].length; k++) {
                                    if(this.form.filtros[j]==this.form.parametros[i]){
                                        label.push(this.form.datosf[this.form.filtros[j]][k]);
                                        data.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
                                    }
                                }
                            }
                        }
                    }
                    titulo="Ingresos";
                    grafico="Bar";
                    datos={labels:inferior,label:label,data:data}
                    this.graficas.push({"titulo":titulo.toUpperCase(),"grafica":grafico,"datos":datos});
                    break;
                case "Servicios":
                    $cont=0;
                    $i=this.form.parametros[0]=='Vuelos' ? 0 : 1;
                    if(this.form.parametros.length>1){ //vuelos y pasajeros
                        for ($j = 0; j < this.form.filtros.length; j++) {
                            if(this.form.datosf[this.form.filtros[j]]){
                                for ($k = 0; k < this.form.datosf[this.form.filtros[j]].length; k++) {
                                    label.push(this.form.parametros[i]+" "+this.form.filtros[j]+" "+this.form.datosf[this.form.filtros[j]][k]);
                                    stack.push(cont);
                                    data.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
                                    for ($p = 0; p < this.form.filtrosP.length; p++) {
                                        label.push(" Pasajeros "+this.form.filtros[j]+" "+this.form.datosf[this.form.filtros[j]][k]+" "+this.form.filtrosP[p]);
                                        stack.push(cont);
                                        data.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
                                    }
                                    cont++;
                                }
                            }
                        }
                    }else{ //vuelo ó pasajero
                        if(i==0){//es vuelo
                            for ($j = 0; j < this.form.filtros.length; j++) {
                                if(this.form.datosf[this.form.filtros[j]]){
                                    for ($k = 0; k < this.form.datosf[this.form.filtros[j]].length; k++) {
                                        label.push(this.form.parametros[i]+" "+this.form.filtros[j]+" "+this.form.datosf[this.form.filtros[j]]);
                                        data.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
                                    }
                                }
                            }
                        }
                        else{//es pasajero
                            i=0;
                            for ($k = 0; k < this.form.filtrosP.length; k++) {
                                label.push(this.form.parametros[i]+" "+this.form.filtrosP[k]);
                                stack.push(cont);
                                cont++;
                                data.push([this.aleatorio(),this.aleatorio(),this.aleatorio(),this.aleatorio()]);
                            }
                        }
                    }


                    titulo="Servicios";
                    inferior=[ 'Abril', 'Mayo'];
                    grafico="BarG";
                    datos={labels:inferior,label:label,stack:stack,data:data}
                    this.graficas.push({"titulo":titulo.toUpperCase(),"grafica":grafico,"datos":datos});
                    break;
            }
        }*/
    }

}