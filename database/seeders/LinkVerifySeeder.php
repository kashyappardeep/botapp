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

                'status' => 2,
                'type' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '2',
                'description' => '1K - 4.9K views = +25K',
                'status' => 2,
                'type' => 1,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '3',
                'description' => '5K - 9.9K views = +50K',
                'status' => 2,
                'type' => 1,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '4',
                'description' => '10K - 49.9K views = +100K',
                'type' => 1,
                'status' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '5',
                'description' => '50K - 99.9K views = +500K',
                'type' => 1,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '6',
                'description' => '100K - 499.9K views = +1M',
                'status' => 2, 'type' => 1,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '7',
                'description' => '500K - 999.9K views = +5M',
                'status' => 2, 'type' => 1,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '8',
                'description' => '1M+ views = +10M',
                'status' => 2, 'type' => 1,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '9',
                'description' => 'You post about Digitron on your Facebook page.',
                'status' => 2, 'type' => 2,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '10',
                'description' => 'Use the hashtags of Digitron, such as - #Digitron, #Freetron, and #Tronoxfreetron.',
                'status' => 2, 'type' => 2,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => '10',
                'description' => 'Use your referral line in the given post.',
                'type' => 2,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
