<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JSONResponse;

class email
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
        if (substr($email,strlen($email)-4) == '.com' && strlen($email)>=6 && strlen($email)<=50) {
             $user = User::where('email',$email);
             if($user->count() > 0){
                 return new JSONResponse(['status' => 'error', 'error'=>'Email already used'] ,400);
             }
             else{
                 return $next($request);
             }
        }
        else{
            return new JSONResponse(['status' => 'error', 'error'=>'Provide correct email'] ,400);
        }
    }
}
