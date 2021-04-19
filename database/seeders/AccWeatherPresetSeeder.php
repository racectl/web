<?php

namespace Database\Seeders;

use App\Models\Presets\AccWeatherPreset;
use Illuminate\Database\Seeder;

class AccWeatherPresetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inserts = [
            [
                'community_id' => 0,
                'name' => 'Clear',
                'ambient_temp' => 27,
                'cloud_level' => 25,
                'rain' => 0,
                'weather_randomness' => 1,
                'simracer_weather_conditions' => 0,
                'is_fixed_condition_qualification' => 0,
            ],            [
                'community_id' => 0,
                'name' => 'Cloudy',
                'ambient_temp' => 22,
                'cloud_level' => 55,
                'rain' => 0,
                'weather_randomness' => 1,
                'simracer_weather_conditions' => 0,
                'is_fixed_condition_qualification' => 0,
            ],            [
                'community_id' => 0,
                'name' => 'Light Rain',
                'ambient_temp' => 21,
                'cloud_level' => 62,
                'rain' => 9,
                'weather_randomness' => 1,
                'simracer_weather_conditions' => 0,
                'is_fixed_condition_qualification' => 0,
            ],            [
                'community_id' => 0,
                'name' => 'Medium Rain',
                'ambient_temp' => 20,
                'cloud_level' => 70,
                'rain' => 27,
                'weather_randomness' => 1,
                'simracer_weather_conditions' => 0,
                'is_fixed_condition_qualification' => 0,
            ],            [
                'community_id' => 0,
                'name' => 'Heavy Rain',
                'ambient_temp' => 14,
                'cloud_level' => 88,
                'rain' => 62,
                'weather_randomness' => 1,
                'simracer_weather_conditions' => 0,
                'is_fixed_condition_qualification' => 0,
            ],            [
                'community_id' => 0,
                'name' => 'Storm',
                'ambient_temp' => 11,
                'cloud_level' => 100,
                'rain' => 90,
                'weather_randomness' => 1,
                'simracer_weather_conditions' => 0,
                'is_fixed_condition_qualification' => 0,
            ],
        ];
        AccWeatherPreset::insert($inserts);
    }
}
