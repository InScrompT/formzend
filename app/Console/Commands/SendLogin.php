<?php

namespace App\Console\Commands;

use App\Account;
use App\Events\LoginRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

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
    public function handle(): int
    {
        $userArgument = Validator::make($this->arguments(), [
            'user' => ['required', 'email', 'exists:accounts,email']
        ]);

        if ($userArgument->fails()) {
            $this->error('User does not exist');
            return 1;
        }

        $account = Account::whereEmail($this->argument('user'))->first();
        event(new LoginRequest($account));

        $this->info('Magic link has been sent to ' . $account->email);

        return 0;
    }
}
