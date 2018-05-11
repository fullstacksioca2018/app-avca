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
        switch (Auth::user()->role) {
            case 'Gerente General':
                $auxURL='/reportes';
                break;
            case 'Gerente RRHH':
                $auxURL='/rrhh/backend/admin';
                break;
            case 'Gerente Sucursales':
                $auxURL='/rutas';
                break;
            default:
                $auxURL='/rrhh/frontend';
                break;
        }

        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }
        return property_exists($this, 'redirectTo') ?  $auxURL : $this->redirectTo;

    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect('/rrhh/frontend');
    }

}
