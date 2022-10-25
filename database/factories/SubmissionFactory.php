<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Submission;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Submission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account_id' => rand(1, 10),
            'website_id' => rand(1, 100),
            'data' => [
                'name' => fake()->name,
                'email' => fake()->email,
                'phone' => fake()->phoneNumber,
                'address' => fake()->address,
            ],
        ];
    }
}
