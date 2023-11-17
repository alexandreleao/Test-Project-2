<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCountry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   

       /* if(!in_array($request->country, $country)&& !request()->is('unavailable')){
            return redirect()->route('unavailable');
        }*/

        if ($request->country && !in_array($request->country, array("us", "in", "afg", "pt-br"))) {
            return redirect("unavailable");
        }

        return $next($request);
    }
}
