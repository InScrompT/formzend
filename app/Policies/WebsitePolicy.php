<?php

namespace App\Policies;

use App\Account;
use App\Website;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebsitePolicy
{
    use HandlesAuthorization;

    /**
     * @param Account $account
     * @param Website $website
     * @return bool
     */
    public function listSubmissions(Account $account, Website $website)
    {
        return $account->id === $website->account_id;
    }

    /**
     * @param Account $account
     * @param Website $website
     * @return bool
     */
    public function exportSubmissions(Account $account, Website $website)
    {
        return $account->id === $website->account_id;
    }
}
