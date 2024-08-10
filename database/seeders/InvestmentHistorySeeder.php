<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InvestmentHistory;
use App\Models\User;
use Faker\Factory as Faker;

class InvestmentHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();

        // Check if there are any users in the database
        if ($users->isEmpty()) {
            $this->command->info('No users found, skipping InvestmentHistorySeeder');
            return;
        }

        foreach (range(1, 50) as $index) {
            $user = $users->random();

            InvestmentHistory::create([
                'user_id' => $user->id,
                'telegram_id' => $user->telegram_id,
                'amount' => $faker->randomFloat(2, 10, 1000), // Random float between 10 and 1000
                'tx_hash' => $this->generateTransactionHash(),
                'status' => 1,
                'order_id' => $faker->unique()->randomNumber(8), // Unique order ID
                'address' => $this->generateWalletAddress(), // Custom function to generate wallet address
                'invest_at' => $faker->dateTimeThisYear, // Date and time within the current year
            ]);
        }
    }

    /**
     * Generate a realistic transaction hash.
     *
     * @return string
     */
    private function generateTransactionHash()
    {
        return bin2hex(random_bytes(32)); // Generates a 64-character hexadecimal string
    }

    /**
     * Generate a realistic wallet address.
     *
     * @return string
     */
    private function generateWalletAddress()
    {
        return '0x' . bin2hex(random_bytes(20)); // Generates a 40-character hexadecimal string prefixed with '0x'
    }
}
