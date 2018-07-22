<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

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
        return $next($request);

    }

    public function hendler()
    {
        if (Auth::check()) 
        { 
            if(Auth::user()->is_admin) 
                return $next($request);
        }

        return Redirect::back()->withErrors(['msg', 'Немате приступ овом делу апликације.']);    
    }
}
