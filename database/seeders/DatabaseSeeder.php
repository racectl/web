<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

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
            AccWeatherPresetSeeder::class,
            AccAssistRulesDefaultSeeder::class,
            PresetSeeder::class
        ]);

        if (App::environment(['local', 'testing'])) {
            $this->call(LocalSeeder::class);
        }
    }
}
