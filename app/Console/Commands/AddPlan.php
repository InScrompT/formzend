<?php

namespace App\Console\Commands;

use App\Models\Plan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class AddPlan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new plan to the system';

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
     *
     * @return int
     */
    public function handle(): int
    {
        $title = $this->ask('Enter plan name');
        $price = $this->ask('Enter the plan price');
        $quantity = $this->ask('Enter plan credits');
        $available = $this->confirm('Make it available?');

        $validator = Validator::make(compact('title', 'price', 'quantity', 'available'), [
            'title' => ['required'],
            'price' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'available' => ['required', 'boolean']
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first());

            return 1;
        }

        $plan = new Plan();

        $plan->name = $title;
        $plan->amount = $price;
        $plan->quantity = $quantity;
        $plan->available = $available;

        $plan->save();
        $this->info('Plan with name ' . $title . ' has been created');

        return 0;
    }
}
