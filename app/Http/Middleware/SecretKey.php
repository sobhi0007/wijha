<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecretKey
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
        if(!$request->has('secret_key') )
           return response()->json([
            'success' => false,
            'status'  => 403 ,
            'error'   => 'Secret key is required',
        ]);

        if( $request->secret_key !== 'Ms654Pomssdc-P72YhfdF29Lw-OvTJ62K9kk0L')
        return response()->json([
            'success' => false,
            'status'  => 403 ,
            'error'   => 'Secret key is secret key is invalid',
        ]);

        return $next($request);
    }
}
