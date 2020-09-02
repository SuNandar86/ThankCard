<?php

namespace App\Http\Middleware;

use Closure;
use App\Helper;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){   
        
        if(\Session::has('User') && \Session::get('User')){
             if(!Helper::AUTHORIZE()){
                return redirect('unauthoirze');
             }
             return $next($request);
        } 
        return redirect('login'); 
    }
}