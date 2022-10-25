<?php

namespace App\Listeners;

use App\Enums\ActivityType;
use App\Events\CreditsExhausted;
use App\Mail\CreditExhausted;
use App\Models\Account;
use App\Models\Activity;
use Illuminate\Support\Facades\Mail;

class SendCreditsExhausted
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

            return Activity::create([
                'account_id' => $event->account->id,
                'type' => ActivityType::CreditExhausted
            ]);
        }

        if ($activityCheck->created_at->diffInHours(now()) > 48) {
            $activityCheck->delete();
            $this->sendNotification($event->account);

            return Activity::create([
                'account_id' => $event->account->id,
                'type' => ActivityType::CreditExhausted
            ]);
        }

        // Do nothing if we've sent a notification in the past 48 hours
        return null;
    }

    private function sendNotification(Account $account)
    {
        Mail::to($account->email)
            ->send(new CreditExhausted($account));
    }
}
