<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $faker = Faker::create('ja_JP');

        User::create([
            'last_name' => '黒田',
            'first_name' => '直道',
            'email' => 'customer@localhost.com',
            'password' => bcrypt('nkuroda'),
            'phone_number' => '08023770943',
            'category' => 'customer',
            'status' => 3,
        ]);

        User::create([
            'company_id' => '1',
            'role_id' => '1',
            'last_name' => '黒田',
            'first_name' => '直道',
            'email' => 'client@localhost.com',
            'password' => bcrypt('nkuroda'),
            'phone_number' => '08023770943',
            'category' => 'client',
            'status' => 3,
        ]);

        for($i = 0; $i < 10; $i++) {
            User::create([
                'last_name' => $faker->lastName,
                'first_name' => $faker->firstName,
                'email' => $faker->safeEmail,
                'password' => $faker->password,
                'phone_number' => $faker->phoneNumber,
                'category' => 'customer',
                'status' => $faker->numberBetween($min = 1, $max = 3),
            ]);
        }

        for($i = 0; $i < 10; $i++) {
            User::create([
                'company_id' => '1',
                'role_id' => '1',
                'last_name' => $faker->lastName,
                'first_name' => $faker->firstName,
                'email' => $faker->safeEmail,
                'password' => $faker->password,
                'phone_number' => $faker->phoneNumber,
                'category' => 'client',
                'status' => $faker->numberBetween($min = 1, $max = 3),
            ]);
        }

    }
}
