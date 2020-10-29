<?php

namespace Database\Factories;

use App\Account;
use App\Website;
use App\Submission;
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
            'account_id' => Account::factory(),
            'website_id' => Website::factory(),
            'data' => [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'phone' => $this->faker->phoneNumber,
                'address' => $this->faker->address,
            ],
        ];
    }
}
