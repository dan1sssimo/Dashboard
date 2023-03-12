<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(\Auth::user()->admin === "yes" || \Auth::user()->manager === "yes" || \Auth::user()->teamlead === "yes" || \Auth::user()->chief === "yes")
        {
            return $next($request);
        }
        
        else
        {
            return redirect('/error_page');
        }
    }
}
