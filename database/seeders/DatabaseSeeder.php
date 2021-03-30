<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CarSeeder::class,
            TrackSeeder::class,
            NwsrSeeder::class,
            AccWeatherPresetSeeder::class
        ]);
    }
}
