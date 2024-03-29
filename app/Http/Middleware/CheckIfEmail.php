<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class CheckIfEmail
{
    /**
     * Check if it really is an email or something else.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $validator = Validator::make(['email' => $request->route('email')], [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->view('website.error', [
                'title' => 'Invalid Email',
                'error' => 'Please enter a valid email. The format is ' . route('form', 'your@email.com')
            ])->setStatusCode(400);
        }

        return $response;
    }
}
