<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Room;
use App\Tower;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->delete();

        $faker = Faker::create('ja_JP');
        $towers = Tower::all();

        foreach ($towers as $tower) {
            for($i = 0; $i < 10; $i++) {
                $room = new Room([
                    'name' => $faker->buildingNumber,
                    'leave_apply_span' => $faker->randomDigit,
                    'contract_span' => $faker->randomDigit,
                    'manage_code' => $faker->sentence,
                    'memo' => $faker->text,
                ]);
                $tower->rooms()->save($room);
            }
        }
    }
}
