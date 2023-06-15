<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;
class Sanctum
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->token;

        if(!$token){
            return response()->json([
                'success' => false,
                'error' => 'Token is required',
            ]);
        }

        if (!PersonalAccessToken::findToken($token))
        {
            return response()->json([
            'success' => false,
            'status' =>  403,
            'error' => 'Token expired',
            ]);
        }

        return $next($request);
      
    }
}