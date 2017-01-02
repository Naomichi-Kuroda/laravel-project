<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->delete();

        $faker = Faker::create('ja_JP');

        for($i = 0; $i < 50; $i++) {
            Company::create([
                'name' => $faker->company,
                'zip_code' => $faker->postcode,
                'prefecture' => $faker->prefecture,
                'city' => $faker->city,
                'town' => $faker->streetAddress,
                'phone_number' => $faker->phoneNumber,
                'memo' => $faker->text,
            ]);
        }
    }
}
