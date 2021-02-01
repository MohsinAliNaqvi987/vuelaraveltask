<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JSONResponse;

class confirmPassword
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
        if ($request->confirmPassword == $request->password)
            return $next($request);
        else
            return new JSONResponse(['status' => 'error', 'error'=>'Provide same password and confirm password'] ,400);

    }
}
