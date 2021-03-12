<?php

namespace Database\Factories\Configs\ACC;

use App\Models\AccConfig;
use App\Models\Configs\ACC\AccAssistRules;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccAssistRulesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccAssistRules::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'acc_config_id' => AccConfig::factory(),
            'stability_control_level_max' => $this->faker->numberBetween(0, 100),
            'disable_autosteer' => $this->faker->boolean,
            'disable_auto_lights' => $this->faker->boolean,
            'disable_auto_wiper' => $this->faker->boolean,
            'disable_auto_engine_start' => $this->faker->boolean,
            'disable_auto_pit_limiter' => $this->faker->boolean,
            'disable_auto_gear' => $this->faker->boolean,
            'disable_auto_clutch' => $this->faker->boolean,
            'disable_ideal_line' => $this->faker->boolean,
        ];
    }

    public function defaults()
    {
        return $this->state(function (array $attributes) {
            return [
                'stability_control_level_max' => 25,
                'disable_autosteer' => 1,
                'disable_auto_lights' => 0,
                'disable_auto_wiper' => 0,
                'disable_auto_engine_start' => 0,
                'disable_auto_pit_limiter' => 0,
                'disable_auto_gear' => 0,
                'disable_auto_clutch' => 0,
                'disable_ideal_line' => 0,
            ];
        });
    }
}
