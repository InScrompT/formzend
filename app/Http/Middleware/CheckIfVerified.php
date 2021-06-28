<?php

namespace App\Http\Middleware;

use Closure;
use App\Website;
use App\Account;
use App\Events\NewWebsite;

class CheckIfVerified
{
    /**
     * Check if the email is verified for the particular host.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $host = $request->header('referer');
        $email = $request->route('email');

        $account = Account::firstOrCreate(['email' => $email]);
        $accountWebsite = $account->websites->firstWhere('url', $host);

        if (is_null($accountWebsite)) {
            $newWebsite = new Website(['url' => $host, 'account_id' => $account->id]);
            $newWebsite->saveOrFail();

            event(new NewWebsite($newWebsite));

            return redirect()->route('website.verify.show', [$host, $email]);
        }

        if (!$accountWebsite->verified) {
            return redirect()->route('website.verify.remind', [
                $account->id, $accountWebsite->id
            ]);
        }

        // Basically means that everything is okay and send an email.
        return $response;
    }
}
