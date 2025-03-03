<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckParameter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,string $param): Response
    {

        if ($param == '1') {
            
          return redirect()->route("1");
        } elseif ($param == '2') {
            return redirect()->route("2");
        } elseif ($param == '3') {
            return redirect()->route("3");
        } 

        return $next($request);
    }
}
