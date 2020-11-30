<?php

namespace App\Console\Commands;

use App\Account;
use App\Activity;
use App\Enums\ActivityType;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class MakeLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'login:make {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make magic login link for a user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userArgument = \Validator::make($this->arguments(), [
            'user' => 'required|email'
        ]);

        $userArgument->fails() ? $this->handleUserID() : $this->handleUserEmail();
    }

    private function handleUserID()
    {
        try {
            $account = Account::findOrFail($this->argument('user'));

            $this->info('Magic link for user ' . $account->email . ' is ' . $this->makeMagicLink($account));
        } catch (\Exception $e) {
            $this->error('User (' . $this->argument('user') . ') not found');
        }
    }

    private function handleUserEmail()
    {
        try {
            $account = Account::whereEmail($this->argument('user'))->firstOrFail();

            $this->info('Magic link for user ' . $account->email . ' is ' . $this->makeMagicLink($account));
        } catch (\Exception $e) {
            $this->error('User (' . $this->argument('user') . ') not found');
        }
    }

    private function makeMagicLink(Account $account)
    {
        $activity = new Activity;

        $activity->account_id = $account->id;
        $activity->type = ActivityType::LoginRequested;
        $activity->login_key = Str::uuid();

        $activity->saveOrFail();

        return route('login.verify', [$account->account->id, $activity->login_key]);
    }
}
