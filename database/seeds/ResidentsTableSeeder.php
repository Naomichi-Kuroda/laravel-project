<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Resident;
use App\Room;

class ResidentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('residents')->delete();

        $faker = Faker::create('ja_JP');
        $rooms = Room::all();

        foreach ($rooms as $room) {
            for($i = 0; $i < 2; $i++) {
                $resident = new Resident([
                    'name' => $faker->name,
                    'phone_number' => $faker->phoneNumber,
                    'start_date' => $faker->dateTime,
                    'end_date' => $faker->dateTime,
                    'limit_date' => $faker->dateTime,
                    'memo' => $faker->text,
                ]);
                $room->residents()->save($resident);
            }
        }
    }
}
