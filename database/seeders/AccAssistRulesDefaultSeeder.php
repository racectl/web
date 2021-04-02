<?php

namespace Database\Seeders;

use App\Models\Configs\ACC\AccAssistRules;
use Illuminate\Database\Seeder;

class AccAssistRulesDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccAssistRules::create([
            'preset_name' => 'All Disabled',
            'preset_for_community' => 0,
            'stability_control_level_max' => 0,
            'disable_autosteer' => 1,
            'disable_auto_lights' => 1,
            'disable_auto_wiper' => 1,
            'disable_auto_engine_start' => 1,
            'disable_auto_pit_limiter' => 1,
            'disable_auto_gear' => 1,
            'disable_auto_clutch' => 1,
            'disable_ideal_line' => 1,
        ]);

        AccAssistRules::create([
            'preset_name' => 'All Enabled',
            'preset_for_community' => 0,
            'stability_control_level_max' => 100,
            'disable_autosteer' => 0,
            'disable_auto_lights' => 0,
            'disable_auto_wiper' => 0,
            'disable_auto_engine_start' => 0,
            'disable_auto_pit_limiter' => 0,
            'disable_auto_gear' => 0,
            'disable_auto_clutch' => 0,
            'disable_ideal_line' => 0,
        ]);

        AccAssistRules::create([
            'preset_name' => 'Disable Autosteer - 25 Max Stability',
            'preset_for_community' => 0,
            'stability_control_level_max' => 25,
            'disable_autosteer' => 1,
            'disable_auto_lights' => 0,
            'disable_auto_wiper' => 0,
            'disable_auto_engine_start' => 0,
            'disable_auto_pit_limiter' => 0,
            'disable_auto_gear' => 0,
            'disable_auto_clutch' => 0,
            'disable_ideal_line' => 0,
        ]);
    }
}
