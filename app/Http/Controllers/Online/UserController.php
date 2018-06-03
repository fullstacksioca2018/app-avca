<?php

namespace App\Http\Controllers\Online;

use Auth;
use stdClass;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\operativo\Sucursal;
use App\Models\online\Cliente; 
use App\Models\online\Boleto;
use App\Models\online\Vuelo;
use App\Models\online\Ruta;
use App\Online;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function boletos(){
        $boletos=Auth::guard('online')->user()->boletos(Auth::guard('online')->user()->id);

        $TodoBoletos=array();


        foreach ($boletos as $boletoaux) {
            $boleto=Boleto::find($boletoaux->id);
                        
            $objAUX= new stdClass();
            $objAUX->codvuelos =$boleto->vuelo->n_vuelo;
            $objAUX->pasajero=$boleto->primerNombre." ".$boleto->apellido;
            $objAUX->fecha_salida=$boleto->vuelo->fecha_salida;
            $objAUX->destino=$boleto->vuelo->segmentos[0]->ruta->origen->nombre;
            $objAUX->hasta=$boleto->vuelo->segmentos[0]->ruta->destino->nombre;
            $objAUX->estatus=$boleto->boleto_estado;
            array_push($TodoBoletos, $objAUX);
        }
        $sucursales = Sucursal::orderBy('ciudad','ASC')->get();

          return view('online.componentes.MisBoletos')->with('boletos',$TodoBoletos)->with('sucursales',$sucursales);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('online.componentes.ModificarPerfil');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Auth::guard('online')->user()->cliente($id);

        return view('online.componentes.ModificarPerfil',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        // dd($request->all());

        $cliente = Auth::guard('online')->user()->cliente($request->user_id);
        $user = Auth::guard('online')->user();

        //dd($cliente);

        if($cliente==null){

            //dd('entro');

            $cliente = new Cliente($request->all());
            $user = Online::find($request->user_id);
            $cliente->user_id =$request->user_id;
            
            /* Manipulación de imagen */
            $file = $request->file('avatar');

            /*Agrega nombre propio a las imagenes*/
            $avatar = "AvatarCliente_".time().'.'.$file->getClientOriginalExtension();

            //dd($avatar);

            /*indica la ruta de la carpeta donde se guardara las imagenes*/
            $path = public_path().'/online/img/avatar/';

            /*Mover imagenes a una carpeta*/
            $file->move($path, $avatar);
            /* Fin de Manipulación de imagen */

            $user->avatar = $avatar;

            $cliente->save();
            $user->save();

        }else{

            $cliente = Cliente::find($request->user_id);
            $user = Online::find($request->user_id);
            $user->name  = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);  

            /* Manipulación de imagen */
            $file = $request->file('avatar');

            /*Agrega nombre propio a las imagenes*/
            $avatar = "AvatarCliente_".time().'.'.$file->getClientOriginalExtension();

            //dd($avatar);

            /*indica la ruta de la carpeta donde se guardara las imagenes*/
            $path = public_path().'/online/img/avatar/';

            /*Mover imagenes a una carpeta*/
            $file->move($path, $avatar);
            /* Fin de Manipulación de imagen */
            $user->avatar = $avatar;
            
            $cliente->nombre = $request->nombre;
            $cliente->apellido = $request->apellido;
            $cliente->tipo_documento = $request->tipo_documento;
            $cliente->documento = $request->documento;
            $cliente->codigo_postal = $request->codigo_postal;
            $cliente->direccion = $request->direccion;
            $cliente->fecha_nacimiento = $request->fecha_nacimiento;
            $cliente->genero = $request->genero;
            $cliente->telefono_movil = $request->telefono_movil;
            $cliente->telefono_fijo = $request->telefono_fijo;
            $cliente->pais = $request->pais;
            //$cliente->fill($request->all());
            //$user->fill($request->all());
            $cliente->save();
            $user->save();
        }
        

        $sucursales = Sucursal::orderBy('ciudad','ASC')->get();
        
        flash("La midificación de su perfil se ha realido exitosamente")->success()->important();
        return redirect('/online/cliente/MiPerfil/'.$user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function MiPerfil($id)
    {
        $boletos=Auth::guard('online')->user()->boletos(Auth::guard('online')->user()->id);
        $cliente = Auth::guard('online')->user()->cliente($id);

        $TodoBoletos=array();


        foreach ($boletos as $boletoaux) {
            $boleto=Boleto::find($boletoaux->id);
                        
            $objAUX= new stdClass();
            $objAUX->codvuelos =$boleto->vuelo->n_vuelo;
            $objAUX->pasajero=$boleto->primerNombre." ".$boleto->apellido;
            $objAUX->documento=$boleto->documento;
            $objAUX->boleto_id=$boleto->id;
            $objAUX->tipo_documento=$boleto->tipo_documento;
            $objAUX->tipo_boleto=$boleto->tipo_boleto;
            $objAUX->localizador=$boleto->localizador;
            $objAUX->fecha_salida=$boleto->vuelo->fecha_salida;
            $objAUX->tarifa_vuelo=$boleto->vuelo->segmentos[0]->ruta->tarifa_vuelo;
            $objAUX->importe_facturado=$boleto->vuelo->segmentos[0]->ruta->tarifa_vuelo;
            $objAUX->duracion=$boleto->vuelo->segmentos[0]->ruta->duracion;
            $objAUX->origen=$boleto->vuelo->segmentos[0]->ruta->origen->nombre;
            $objAUX->sigla_origen=$boleto->vuelo->segmentos[0]->ruta->origen->sigla;
            $objAUX->destino=$boleto->vuelo->segmentos[0]->ruta->destino->nombre;
            $objAUX->sigla_destino=$boleto->vuelo->segmentos[0]->ruta->destino->sigla;
            $objAUX->estatus=$boleto->boleto_estado;
            array_push($TodoBoletos, $objAUX);
        }
        
        //dd($TodoBoletos);

          return view('online.componentes.MiPerfil')->with('boletos',$TodoBoletos)->with('cliente',$cliente);
    }

}
