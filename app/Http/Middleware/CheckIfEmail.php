<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class CheckIfEmail
{
    /**
     * Check if it really is an email or something else.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validator = Validator::make(['email' => $request->route('email')], [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            // TODO: Return a proper response instead of JSON
            return response()->json([
                'error' => 'Please enter a valid email'
            ]);
        }

        return $next($request);
    }
}
