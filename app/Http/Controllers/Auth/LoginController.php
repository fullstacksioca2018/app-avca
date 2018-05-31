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
        switch (Auth::user()->modulo) {
            case 'rrhh':
                $auxURL='/rrhh/backend/admin';
                $this->redirectTo='/rrhh/backend/admin';
                break;
            case 'online':
                $auxURL='/online/inicio';
                $this->redirectTo='/online/inicio';
                break;
            case 'operativo1':
                $auxURL='/taquilla';
                $this->redirectTo='/taquilla';
                break;
            case 'operativo2':
                $auxURL='/vuelos';
                $this->redirectTo='/vuelos';
                break;
            case 'reporte':
                $auxURL='/reportes';
                $this->redirectTo='/reportes';
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
        return redirect('/');
    }

}
