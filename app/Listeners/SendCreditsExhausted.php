<?php

namespace App\Listeners;

use App\Account;
use App\Activity;
use App\Enums\ActivityType;
use App\Mail\CreditExhausted;
use App\Events\CreditsExhausted;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCreditsExhausted implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param CreditsExhausted $event
     * @return void
     * @throws \Exception
     */
    public function handle(CreditsExhausted $event)
    {
        $activityCheck = Activity::whereAccountId($event->account->id)
            ->whereType(ActivityType::CreditExhausted)
            ->latest()
            ->first();

        if (is_null($activityCheck)) {
            $this->sendNotification($event->account);

            Activity::create([
                'account_id' => $event->account->id,
                'type' => ActivityType::CreditExhausted
            ]);
        }

        if ($activityCheck->created_at->diffInHours(now()) > 48) {
            $activityCheck->delete();
            $this->sendNotification($event->account);

            Activity::create([
                'account_id' => $event->account->id,
                'type' => ActivityType::CreditExhausted
            ]);
        }
    }

    private function sendNotification(Account $account)
    {
        \Mail::to($account->email)
            ->send(new CreditExhausted($account));
    }
}
