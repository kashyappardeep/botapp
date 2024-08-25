<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class withdrawSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('withdraw')->insert([
            [
                'user_id' => 1,
                'amount' => 50.00,
                'status' => 'pending',
                'address' => '0x123456789abcdef',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'amount' => 75.50,
                'status' => 'completed',
                'address' => '0xfedcba987654321',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'amount' => 120.25,
                'status' => 'failed',
                'address' => '0xabcdef123456789',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more records as needed
        ]);
    }
}
