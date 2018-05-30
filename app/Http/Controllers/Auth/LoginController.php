<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
    protected $redirectTo = '/rrhh/backend/admin';
    // protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }
    public function showLoginForm()
    {
        // return view('auth.login');
        return view('auth.login');
    }

    public function redirectPath()
    {
        $auxURL;
        if((Auth::user()->isRole('gerente'))||(Auth::user()->isRole('gerente.RRHH'))||(Auth::user()->isRole('admin'))){
            $auxURL='/rrhh/backend/admin';
            $this->redirectTo='/rrhh/backend/admin';
        }
        else{
            if(Auth::user()->isRole('operador.taquilla')){
                $auxURL='/taquilla';            
                $this->redirectTo='/taquilla';
            }
            else{
                if((Auth::user()->isRole('gerente.sucursales'))||(Auth::user()->isRole('subgerente.sucursal'))){
                    $auxURL='/vuelos';            
                    $this->redirectTo='/vuelos';
                }
                else{
                    if(Auth::user()->isRole('gerente.general')){
                        $auxURL='/reportes';
                        $this->redirectTo='/reportes';
                    }
                }
            }
        }

        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }
        return property_exists($this, 'redirectTo') ?  $auxURL : $this->redirectTo;

    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect('/');
    }

}
