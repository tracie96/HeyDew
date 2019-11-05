<?php

namespace App\Http\Middleware;

use Closure;

class CORS
{

    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, HEAD, PUT, PATCH, DELETE');
        $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
        $response->header('Access-Control-Allow-Origin', '*');
        return $response;
    }


}
