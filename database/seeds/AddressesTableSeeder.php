<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Address;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->delete();

        $faker = Faker::create('ja_JP');

        for($i = 0; $i < 1000; $i++) {
            Address::create([
                'zip_code' => $faker->postcode,
                'prefecture' => $faker->prefecture,
                'city' => $faker->city,
                'town' => $faker->streetAddress,
            ]);
        }
    }
}
