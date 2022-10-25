<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Submission;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubmissionPolicy
{
    use HandlesAuthorization;

    /**
     * @param Account $account
     * @param \App\Models\Submission $submission
     * @return bool
     */
    public function view(Account $account, Submission $submission)
    {
        return $account->id === $submission->account_id;
    }

    /**
     * @param Account $account
     * @param \App\Models\Submission $submission
     * @return bool
     */
    public function export(Account $account, Submission $submission)
    {
        return $account->id === $submission->account_id;
    }

    /**
     * @param Account $account
     * @return bool
     */
    public function create(Account $account) {
        return $account->allowed > 0;
    }
}
