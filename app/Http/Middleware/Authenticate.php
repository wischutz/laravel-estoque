<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next){

        if(!Auth::check()){
            return redirect()->route('admin.login');            
        }   
        
        return $next($request);
    }
    
}
