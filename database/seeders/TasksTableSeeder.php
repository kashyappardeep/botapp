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
                'direct' => '',
                'description' => 'Welcome bonus',
                'amount' => 1,
                'images' => 'faHandPaper',
                'type' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'direct' => '',
                'description' => 'Rent Your First Miner Booster',
                'amount' => 5,
                'images' => 'faBullhorn',
                'type' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'direct' => '',
                'description' => 'Invite your first friend',
                'amount' => 10,
                'images' => 'faUsers',
                'type' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'direct' => '1',
                'description' => '1 Referral',
                'amount' => 1,
                'images' => '',
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),

            ], [
                'direct' => '5',
                'description' => '5 Referral',
                'amount' => 3,
                'images' => '',
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'direct' => '10',
                'description' => '10 Referral',
                'amount' => 5,
                'images' => '',
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'direct' => '25',
                'description' => '25 Referral',
                'amount' => 10,
                'images' => '',
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'direct' => '50',
                'description' => '50 Referral',
                'amount' => 20,
                'images' => '',
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'direct' => '100',
                'description' => '100 Referral',
                'amount' => 40,
                'images' => '',
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'direct' => '500',
                'description' => '500 Referral',
                'amount' => 100,
                'images' => '',
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'direct' => '1000',
                'description' => '1000 Referral',
                'amount' => 250,
                'images' => '',
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'direct' => '10000',
                'description' => '10000 Referral',
                'amount' => 3000,
                'images' => '',
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'direct' => '20000',
                'description' => '20000 Referral',
                'amount' => 7000,
                'images' => '',
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'direct' => '100000',
                'description' => '100000 Referral',
                'amount' => 25000,
                'images' => '',
                'type' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
