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
            ['user_id' => null, 'address' => '0x7A1B62f116D700aA0Fb084aBA857baad3785964a', 'amount' => null],
            ['user_id' => null, 'address' => '0xAC8625c3a301a0F6DC6C681c4482093248Ec29B0', 'amount' => null],
            ['user_id' => null, 'address' => '0xfF3f030cCF622D0d15bF7b02Be38975C3A73C30D', 'amount' => null],
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
