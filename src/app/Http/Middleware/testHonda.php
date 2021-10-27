<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class testHonda
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        session(['test' => "honda"]);
;    
        return $next($request);
    }
}