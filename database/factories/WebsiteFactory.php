<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Website::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account_id' => rand(1, 10),
            'url' => fake()->unique()->domainName,
            'verified' => true,
        ];
    }

    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'verified' => false
        ]);
    }
}
