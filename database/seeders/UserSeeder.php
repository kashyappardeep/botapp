<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            User::create([
                'telegram_id' => $faker->unique()->randomNumber(8),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'referral_by' => $faker->randomNumber(8),
                'status' => 2, // Example values for status
                'wallet' => $faker->randomNumber(0.00),
                'claimable_amt' => $faker->randomFloat(2, 0, 1000), // Example random float for claimable amount
                'last_claim_timestamp' => $faker->dateTimeThisYear,
            ]);
        }
    }
}
