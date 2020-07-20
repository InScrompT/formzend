<?php

namespace App\Http\Middleware;

use App\Account;
use App\Website;
use Closure;

class CheckIfVerifiedEmail
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
        $host = $request->getHost();
        $email = $request->route('email');

        $account = Account::where('email', $email)->first();
        if (!$account->exists()) {
            $newAccount = new Account;
            $newAccount->email = $email;
            $newAccount->saveOrFail();

            return response()->json([
                'message' => 'new account. Save and send verification email'
            ]);
        }

        $accountWebsite = $account->websites->where('url', $host)->first();
        if (is_null($accountWebsite)) {
            $newAccountWebsite = new Website;
            $newAccountWebsite->account_id = $account->id;
            $newAccountWebsite->url = $host;
            $newAccountWebsite->saveOrFail();

            return response()->json([
                'message' => 'old account, new url. Send verification email'
            ]);
        }

        if (!$accountWebsite->verified) {
            return response()->json([
                'message' => 'old account, old url, not verified yet.'
            ]);
        }

        // Basically means that everything is okay and send an email.
        return $next($request);
    }
}
