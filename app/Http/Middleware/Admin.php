<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Admin
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
        //check is user logged in and also is admin
        if(Auth::check()) {  //check the user is logged in 
            if(Auth::user()->isAdmin()) {  //use User isAdmin  metod to also check user is role admin
                return $next($request);
            }

        }
        
        //redirect to a custom 404 page found in resources/views/errors - could also redirect to home page '/'
        return redirect('/');   // also 404 ie //return redirect('404');
    }

}
