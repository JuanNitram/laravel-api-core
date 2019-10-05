<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        if($request->server('HTTP_ORIGIN')) {
          header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
          header('Access-Control-Allow-Origin: ' . $request->server('HTTP_ORIGIN'));
        }

        if($request->getMethod() == "OPTIONS"){
            $headers = [
                'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
                'Access-Control-Allow-Headers' => 'Content-Type, Origin, Authorization'
            ];
            return \Response::make('OK', 200, []);
        }

        return $next($request);
    }
}
