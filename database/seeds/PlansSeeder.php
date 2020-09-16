<?php

use App\Plan;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createFreePlan();
        $this->createBuddingPlan();
    }

    public function createFreePlan()
    {
        $plan = new Plan();

        $plan->amount = 0;
        $plan->name = 'Free';
        $plan->quantity = 150;
        $plan->available = false;

        $plan->save();
    }

    public function createBuddingPlan()
    {
        $plan = new Plan();

        $plan->amount = 2;
        $plan->quantity = 2000;
        $plan->name = 'Budding';

        $plan->save();
    }
}
