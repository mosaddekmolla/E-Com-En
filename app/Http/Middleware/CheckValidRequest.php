<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckValidRequest
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
        if($request->password=='1234'){
            return $next($request);
        }else{
            return redirect()->route('login_form');
        }
    }
}
