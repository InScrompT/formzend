<?php

namespace App\Console\Commands;

use App\Account;
use App\Events\LoginRequest;
use Illuminate\Console\Command;

class SendLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'login:send {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send magic login link to a user';

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

    private function handleUserEmail()
    {
        try {
            $account = Account::whereEmail($this->argument('user'))->firstOrFail();
            $this->sendEmail($account);

            $this->info('Magic link has been sent to ' . $account->email);
        } catch (\Exception $e) {
            $this->error('User (' . $this->argument('user') . ') not found');
        }
    }

    private function handleUserID()
    {
        try {
            $account = Account::findOrFail($this->argument('user'));
            $this->sendEmail($account);

            $this->info('Magic link has been sent to ' . $account->email);
        } catch (\Exception $e) {
            $this->error('User (' . $this->argument('user') . ') not found');
        }
    }

    private function sendEmail(Account $account)
    {
        event(new LoginRequest($account));
    }
}
