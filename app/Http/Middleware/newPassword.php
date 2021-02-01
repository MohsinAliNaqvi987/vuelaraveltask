<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JSONResponse;

class newPassword
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
        if (strlen($request->newPassword)>=8)
            return $next($request);
        else
            return new JSONResponse(['status' => 'error', 'error'=>'Choose stronger password'] ,400);
    }
}
