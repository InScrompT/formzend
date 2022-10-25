<?php

namespace Tests\Feature\Commands;

use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddPlanTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_plan_valid_data()
    {
        $this->artisan('plan:add')
            ->expectsQuestion('Enter plan name', 'Test')
            ->expectsQuestion('Enter the plan price', 10)
            ->expectsQuestion('Enter plan credits', 1000)
            ->expectsConfirmation('Make it available?', 'yes')
            ->expectsOutput('Plan with name Test has been created')
            ->assertSuccessful();

        $this->assertDatabaseHas(Plan::class, [
            'name' => 'Test',
            'amount' => 10,
            'quantity' => 1000,
            'available' => true
        ]);
    }

    public function test_has_invalid_plan_price()
    {
        $this->artisan('plan:add')
            ->expectsQuestion('Enter plan name', 'Test')
            ->expectsQuestion('Enter the plan price', 'lmao bro')
            ->expectsQuestion('Enter plan credits', 1000)
            ->expectsConfirmation('Make it available?', 'yes')
            ->expectsOutput('The price must be an integer.')
            ->assertFailed();

        $this->assertDatabaseMissing(Plan::class, [
            'name' => 'Test',
            'amount' => 'lmao bro',
            'quantity' => 1000,
            'available' => true
        ]);
    }

    public function test_has_invalid_quantity_price()
    {
        $this->artisan('plan:add')
            ->expectsQuestion('Enter plan name', 'Test')
            ->expectsQuestion('Enter the plan price', 10)
            ->expectsQuestion('Enter plan credits', 'lmao bro')
            ->expectsConfirmation('Make it available?', 'yes')
            ->expectsOutput('The quantity must be an integer.')
            ->assertFailed();

        $this->assertDatabaseMissing(Plan::class, [
            'name' => 'Test',
            'amount' => 10,
            'quantity' => 'lmao bro',
            'available' => true
        ]);
    }
}
