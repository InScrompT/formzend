<?php

namespace App\Policies;

use App\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    /**
     * @param Account $account
     * @return bool
     */
    public function createSubmission(Account $account)
    {
        return $account->allowed > 0;
    }
}
