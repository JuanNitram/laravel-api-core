<?php

namespace App\Http\Middleware;

use Closure;

class IpMiddleware
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
        if($request->ip() != '127.0.0.1'){
            return response()->json([
                'success' => false,
                'message' => 'Ip not authorized.',
            ]);
        }
        return $next($request);
    }
}
