<?php

namespace App\Http\Middleware;

use App\Account;
use Closure;

class Limiter
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
        $allowed = Account::whereEmail($request->route('email'))
            ->first()
            ->allowed;

        if ($allowed) {
            return $next($request);
        }

        return response(['message' => 'credits done, no more submissions'], 401);
    }
}
