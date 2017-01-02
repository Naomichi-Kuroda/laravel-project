<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(ResidencesTableSeeder::class);
        $this->call(TowersTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(ResidentsTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
    }
}
