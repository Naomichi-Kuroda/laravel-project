<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $faker = Faker::create('ja_JP');

        for($i = 0; $i < 10; $i++) {
            Role::create([
                'name' => $faker->colorName,
                'manage' => json_encode(
                    [
                        1
                    ]
                ),
                'content' => json_encode(
                    [
                        1,2
                    ]
                ),
                'residence' => json_encode(
                    [
                    ]
                ),
                'memo' => $faker->text,
            ]);
        }
    }
}
