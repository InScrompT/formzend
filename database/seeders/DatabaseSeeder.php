<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PlansSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(WebsiteSeeder::class);
        $this->call(SubmissionSeeder::class);
    }
}
