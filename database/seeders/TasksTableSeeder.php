<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            [

                'description' => 'Welcome bonus',
                'amount' => 1,
                'type' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Join Chat Group / Page',
                'amount' => 1,
                'type' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'description' => 'Rent Your First Miner Booster',
                'amount' => 5,
                'type' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'description' => 'Invite your first friend',
                'amount' => 10,
                'type' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'description' => 'Follow Tronix Twitter',
                'amount' => 1,
                'type' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => '1 Referral',
                'amount' => 1,
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'description' => '5 Referral',
                'amount' => 3,
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'description' => '10 Referral',
                'amount' => 5,
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'description' => '25 Referral',
                'amount' => 10,
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'description' => '50 Referral',
                'amount' => 20,
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'description' => '100 Referral',
                'amount' => 40,
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'description' => '500 Referral',
                'amount' => 100,
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'description' => '1000 Referral',
                'amount' => 250,
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'description' => '10000 Referral',
                'amount' => 3000,
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'description' => '20000 Referral',
                'amount' => 7000,
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'description' => '100000 Referral',
                'amount' => 25000,
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
