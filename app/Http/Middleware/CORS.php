<?php

namespace App\Http\Middleware;

use Closure;

class CORS
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
        // TODO: Make it exclusive to paid customers only
        header("Access-Control-Allow-Origin: *");

        $headers = [
            'Access-Control-Allow-Methods'=> 'POST, GET',
            'Access-Control-Allow-Headers'=> 'Content-Type, Origin'
        ];

        $response = $next($request);
        foreach($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }
}
