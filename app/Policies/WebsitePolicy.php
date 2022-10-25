<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Website;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebsitePolicy
{
    use HandlesAuthorization;

    /**
     * @param Account $account
     * @param \App\Models\Website $website
     * @return bool
     */
    public function listSubmissions(Account $account, Website $website)
    {
        return $account->id === $website->account_id;
    }

    /**
     * @param \App\Models\Account $account
     * @param \App\Models\Website $website
     * @return bool
     */
    public function exportSubmissions(Account $account, Website $website)
    {
        return $account->id === $website->account_id;
    }
}
