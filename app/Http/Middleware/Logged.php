<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class Logged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {//Verifica se está o token está expirado e se existe
        $logged = false;
        if(Session::has('access_expires_in')){
            $expire = $request->session()->get('expire');
            $now = now()->timestamp;
            if($expire > $now){
                $logged = true;
            }
        }

        if($logged){
            return $next($request);
        }else{
            return redirect('login');
        }
    }
}
