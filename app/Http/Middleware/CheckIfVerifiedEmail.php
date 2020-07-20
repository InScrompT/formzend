<?php

namespace App\Http\Middleware;

use App\Account;
use App\Events\NewWebsite;
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

        $account = Account::firstOrCreate([ 'email' => $email ]);
        $accountWebsite = $account->websites->firstWhere('url', $host);

        if (is_null($accountWebsite)) {
            $newWebsite = new Website(['url' => $host, 'account_id' => $account->id]);
            $newWebsite->save();

            event(new NewWebsite($newWebsite));

            return response()->json([
                'message' => 'old account, new url. Send verification email'
            ]);
        }

        if (!$accountWebsite->verified) {
            event(new NewWebsite($account->websites->firstWhere('url', $host)));
            return response()->json([
                'message' => 'old account, old url, not verified yet.'
            ]);
        }

        // Basically means that everything is okay and send an email.
        return $next($request);
    }
}
