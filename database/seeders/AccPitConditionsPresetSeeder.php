<?php

namespace Database\Seeders;

use App\Models\Presets\AccPitConditionsPreset;
use Illuminate\Database\Seeder;

class AccPitConditionsPresetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccPitConditionsPreset::create([
            'name'                                      => 'No Pit',
            'community_id'                              => 0,
            'pit_window_length_sec'                     => -1,
            'driver_stint_time_sec'                     => -1,
            'mandatory_pitstop_count'                   => 0,
            'max_total_driving_time'                    => -1,
            'is_refuelling_allowed_in_race'             => true,
            'is_refuelling_time_fixed'                  => false,
            'is_mandatory_pitstop_refuelling_required'  => false,
            'is_mandatory_pitstop_tyre_change_required' => false,
            'is_mandatory_pitstop_swap_driver_required' => false,
            'tyre_set_count'                            => 50,
        ]);

        AccPitConditionsPreset::create([
            'name'                                      => 'One Stop - 10 Min - Req Tire Change',
            'community_id'                              => 0,
            'pit_window_length_sec'                     => 600,
            'driver_stint_time_sec'                     => -1,
            'mandatory_pitstop_count'                   => 1,
            'max_total_driving_time'                    => -1,
            'is_refuelling_allowed_in_race'             => true,
            'is_refuelling_time_fixed'                  => false,
            'is_mandatory_pitstop_refuelling_required'  => false,
            'is_mandatory_pitstop_tyre_change_required' => true,
            'is_mandatory_pitstop_swap_driver_required' => false,
            'tyre_set_count'                            => 50,
        ]);

    }
}
