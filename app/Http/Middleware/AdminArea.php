<?php

namespace App\Http\Middleware;

use Closure;

class AdminArea
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

//        if( !\Auth::user()->isAdmin() )
//            abort(404);
        return $next($request);
    }
}
