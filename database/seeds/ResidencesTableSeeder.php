<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Residence;

class ResidencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('residences')->delete();

        $faker = Faker::create('ja_JP');

        for($i = 0; $i < 50; $i++) {
            Residence::create([
                'name' => $faker->country,
                'zip_code' => $faker->postcode,
                'prefecture' => $faker->prefecture,
                'city' => $faker->city,
                'town' => $faker->streetAddress,
            ]);
        }
    }
}
