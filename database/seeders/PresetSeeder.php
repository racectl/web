<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Preset;
use App\Presets\AccAssistRulesPreset;
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
        $this->carPresets();
        $this->assistRulesPresets();
    }

    protected function carPresets()
    {
        //Car Presets
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

    protected function assistRulesPresets()
    {
        $insert = new \stdClass();
        $insert->stabilityControlLevelMax = 0;
        $insert->disableAutosteer = true;
        $insert->disableAutoLights = true;
        $insert->disableAutoWiper = true;
        $insert->disableAutoEngineStart = true;
        $insert->disableAutoPitLimiter = true;
        $insert->disableAutoGear = true;
        $insert->disableAutoClutch = true;
        $insert->disableIdealLine = true;
        Preset::create([
            'community_id' => 0,
            'name' => 'noAssists',
            'display_name' => 'All Disabled',
            'type' => AccAssistRulesPreset::class,
            'data' => json_encode($insert)
        ]);

        $insert = new \stdClass();
        $insert->stabilityControlLevelMax = 100;
        $insert->disableAutosteer = false;
        $insert->disableAutoLights = false;
        $insert->disableAutoWiper = false;
        $insert->disableAutoEngineStart = false;
        $insert->disableAutoPitLimiter = false;
        $insert->disableAutoGear = false;
        $insert->disableAutoClutch = false;
        $insert->disableIdealLine = false;
        Preset::create([
            'community_id' => 0,
            'name' => 'allAssists',
            'display_name' => 'All Enabled',
            'type' => AccAssistRulesPreset::class,
            'data' => json_encode($insert)
        ]);

        $insert = new \stdClass();
        $insert->stabilityControlLevelMax = 25;
        $insert->disableAutosteer = true;
        Preset::create([
            'community_id' => 0,
            'name' => 'nwsr',
            'display_name' => 'Disable Autosteer - 25 Max Stability',
            'type' => AccAssistRulesPreset::class,
            'data' => json_encode($insert)
        ]);
    }
}
