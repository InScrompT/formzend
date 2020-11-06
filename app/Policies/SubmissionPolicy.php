<?php

namespace App\Policies;

use App\Account;
use App\Submission;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubmissionPolicy
{
    use HandlesAuthorization;

    /**
     * @param Account $account
     * @param Submission $submission
     * @return bool
     */
    public function view(Account $account, Submission $submission)
    {
        return $account->id === $submission->account_id;
    }

    /**
     * @param Account $account
     * @param Submission $submission
     * @return bool
     */
    public function export(Account $account, Submission $submission)
    {
        return $account->id === $submission->account_id;
    }
}
