<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Preset;
use App\Presets\AccCarsPreset;
use Illuminate\Database\Seeder;

class PresetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Preset::create([
            'name' => 'accGt3s',
            'community_id' => 0,
            'display_name' => 'GT3s',
            'type' => AccCarsPreset::class,
            'data' => json_encode(Car::accGt3s()->pluck('id'))
        ]);
        Preset::create([
            'name' => 'accGt4s',
            'community_id' => 0,
            'display_name' => 'GT4s',
            'type' => AccCarsPreset::class,
            'data' => json_encode(Car::accGt4s()->pluck('id'))
        ]);
        Preset::create([
            'name' => 'accGt3sAndGt4s',
            'community_id' => 0,
            'display_name' => 'GT3s and GT4s',
            'type' => AccCarsPreset::class,
            'data' => json_encode(Car::accGt3sAndGt4s()->pluck('id'))
        ]);
        Preset::create([
            'name' => 'accAll',
            'community_id' => 0,
            'display_name' => 'All',
            'type' => AccCarsPreset::class,
            'data' => json_encode(Car::acc()->pluck('id'))
        ]);
    }
}
