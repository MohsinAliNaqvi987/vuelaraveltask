<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JSONResponse;

class loginPassword
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
        if (strlen($request->password)>=8)
            return $next($request);
        else
            return new JSONResponse(['status' => 'error', 'error'=>'Enter complete password'] ,400);
    }
}
