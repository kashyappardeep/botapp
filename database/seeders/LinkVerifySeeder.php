<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LinkVerifySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('linkverify')->insert([

            [
                'id' => '1',
                'description' => '100 - 999 views = +10K',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '2',
                'description' => '1K - 4.9K views = +25K',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '3',
                'description' => '5K - 9.9K views = +50K',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '4',
                'description' => '10K - 49.9K views = +100K',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '5',
                'description' => '50K - 99.9K views = +500K',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '6',
                'description' => '100K - 499.9K views = +1M',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '7',
                'description' => '500K - 999.9K views = +5M',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '8',
                'description' => '1M+ views = +10M',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
