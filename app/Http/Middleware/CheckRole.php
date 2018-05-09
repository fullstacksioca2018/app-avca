<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user()){
        //     // switch ($request->user()->roles()[0]->slug) {
        //     //     case 'gerente.general':
        //     //         return redirect('/reportes');
        //     //         break;
        //     //     case 'gerente.rrhh':
        //     //         return redirect('/rrhh/backend/admin');
        //     //         break;
        //     //     case 'gerente.sucursales':
        //     //         break;
        //     //     default:
        //     //         return redirect('/operativo/inicio');
        //     //         break;
        //     // }
        //     return $next($request);
        // }
        // else{
        //     return redirect('login');
            return redirect('/rrhh/backend/admin');
        }
        return $next($request);
        // return $next($request);
    }
}
