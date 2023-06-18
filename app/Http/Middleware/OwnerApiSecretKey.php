<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OwnerApiSecretKey
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
        if ($request->has('secret_key') && $request->secret_key === 'Ms654Pomssdc-P72YhfdF29Lw-OvTJ62K9kk0L') {
            return $next($request);
        } else {
            abort(404);
        }
    }
}
