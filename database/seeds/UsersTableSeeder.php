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
            'email' => 'nkuroda@gmail.com',
            'password' => bcrypt('nkuroda'),
            'phone_number' => '08023770943',
            'user_type' => 'customer',
        ]);
    }
}
