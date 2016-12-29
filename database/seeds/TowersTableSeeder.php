<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Residence;
use App\Tower;

class TowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('towers')->delete();

        $faker = Faker::create('ja_JP');
        $residences = Residence::all();

        foreach ($residences as $residence) {
            for($i = 0; $i < 3; $i++) {
                $tower = new Tower([
                    'name' => $faker->company,
                    'memo' => $faker->text,
                ]);
                $residence->towers()->save($tower);
            }
        }
    }
}
