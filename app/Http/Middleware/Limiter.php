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

        return response()->view('website.error', [
            'title' => 'Credits Exhausted',
            'error' => 'The owner has exhausted the credits. If you\'re the owner, go to dashboard and top-up credits'
        ], 401);
    }
}
