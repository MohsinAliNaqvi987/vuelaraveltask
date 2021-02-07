<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JSONResponse;

class loginEmail
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
        $email = $request->email;
        if (substr($email,strlen($email)-4) == '.com' && strlen($email)>=6 && strlen($email)<=50)
            return $next($request);
        else
            return new JSONResponse(['status' => 'error', 'error'=>'Provide correct email'] ,400);
    }
}
