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
            'account_id' => Account::factory(),
            'url' => $this->faker->domainName,
            'verified' => true,
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'verified' => false
            ];
        });
    }
}
