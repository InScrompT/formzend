<?php

namespace App\Http\Middleware;

use Closure;
use App\Account;
use App\Events\CreditsExhausted;

class Limiter
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allowed = Account::whereEmail($request->route('email'))
            ->firstOrFail();

        if ($allowed->allowed > 0) {
            return $next($request);
        }

        event(new CreditsExhausted($allowed));

        return response()->view('website.error', [
            'title' => 'Credits Exhausted',
            'error' => 'The owner has exhausted the credits. If you\'re the owner, go to dashboard and top-up credits'
        ], 401);
    }
}
