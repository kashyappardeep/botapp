<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addresses = [
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
            ['user_id' => null, 'address' => '0x519538b94fa17E83d3C38114615EdFF3bF41d0d1', 'amount' => null],
        ];

        Address::insert($addresses);
    }
}
