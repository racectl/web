<?php

namespace Database\Factories\Configs\ACC;

use App\Models\Configs\ACC\AccEventRules;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccEventRulesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccEventRules::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'qualify_standing_type'                     => $this->faker->randomElement([1, 2]),
            'pit_window_length_sec'                     => $this->faker->numberBetween(-1, 10 * 60),
            'driver_stint_time_sec'                     => $this->faker->numberBetween(-1, 60 * 60),
            'mandatory_pitstop_count'                   => $this->faker->numberBetween(0, 3),
            'max_total_driving_time'                    => $this->faker->numberBetween(-1, 60 * 60),
            'max_drivers_count'                         => $this->faker->numberBetween(0, 4),
            'is_refuelling_allowed_in_race'             => $this->faker->boolean,
            'is_refuelling_time_fixed'                  => $this->faker->boolean,
            'is_mandatory_pitstop_refuelling_required'  => $this->faker->boolean,
            'is_mandatory_pitstop_tyre_change_required' => $this->faker->boolean,
            'is_mandatory_pitstop_swap_driver_required' => $this->faker->boolean,
            'tyre_set_count'                            => $this->faker->numberBetween(0, 50),
        ];
    }
}
