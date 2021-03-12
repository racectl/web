<?php

namespace Database\Factories\Configs\ACC;

use App\Models\Configs\ACC\AccEventSession;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccEventSessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccEventSession::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hour_of_day'              => $this->faker->numberBetween(0, 23),
            'day_of_weekend'           => $this->faker->numberBetween(1, 3),
            'time_multiplier'          => $this->faker->numberBetween(0, 24),
            'session_type'             => $this->faker->randomElement(['P', 'Q', 'R']),
            'session_duration_minutes' => $this->faker->randomElement([10, 15, 20, 30, 60, 120])
        ];
    }
}
