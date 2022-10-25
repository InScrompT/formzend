<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Repositories\AccountRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

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
        $this->info('Magic link for user ' . $account->email . ' is ' . $this->makeMagicLink($account));

        return 0;
    }

    private function makeMagicLink(Account $account)
    {
        $verificationCode = AccountRepository::generateVerification($account);

        return route('login.verify', [$account->id, $verificationCode]);
    }
}
