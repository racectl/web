<?php

namespace Database\Factories\Configs\ACC;

use App\Models\AccConfig;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Configs\ACC\AccSettings;

class AccSettingsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var  string
     */
    protected $model = AccSettings::class;

    /**
     * Define the model's default state.
     *
     * @return  array
     */
    public function definition(): array
    {
        return [
            'acc_config_id'                => AccConfig::factory(),
            'server_name'                  => $this->faker->sentence,
            'admin_password'               => $this->faker->password,
            'car_group'                    => $this->faker->randomElement(["FreeForAll", "GT3", "GT4", "Cup", "ST"]),
            'track_medals_requirement'     => $this->faker->numberBetween(0, 3),
            'safety_rating_requirement'    => $this->faker->numberBetween(-1, 99),
            'racecraft_rating_requirement' => $this->faker->numberBetween(-1, 99),
            'password'                     => $this->faker->password,
            'spectator_password'           => $this->faker->password,
            'max_car_slots'                => null,
            'dump_leaderboards'            => $this->faker->numberBetween(0, 1),
            'is_race_locked'               => $this->faker->numberBetween(0, 1),
            'randomize_track_when_empty'   => $this->faker->numberBetween(0, 1),
            'central_entry_list_path'      => null,
            'allow_auto_d_q'               => $this->faker->numberBetween(0, 1),
            'short_formation_lap'          => $this->faker->numberBetween(0, 1),
            'dump_entry_list'              => $this->faker->numberBetween(0, 1),
            'formation_lap_type'           => $this->faker->randomElement([0, 1, 3])
        ];
    }

    public function noPasswords(): AccSettingsFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'admin_password'     => '',
                'password'           => '',
                'spectator_password' => ''
            ];
        });
    }

    public function noRequirements(): AccSettingsFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'track_medals_requirement'     => 0,
                'safety_rating_requirement'    => -1,
                'racecraft_rating_requirement' => -1
            ];
        });
    }

    public function defaults(): AccSettingsFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'admin_password'               => null,
                'car_group'                    => 'FreeForAll',
                'track_medals_requirement'     => 0,
                'safety_rating_requirement'    => -1,
                'racecraft_rating_requirement' => -1,
                'password'                     => null,
                'spectator_password'           => null,
                'max_car_slots'                => null,
                'dump_leaderboards'            => 1,
                'is_race_locked'               => 1,
                'randomize_track_when_empty'   => 0,
                'central_entry_list_path'      => null,
                'allow_auto_d_q'               => 0,
                'short_formation_lap'          => 0,
                'dump_entry_list'              => 0,
                'formation_lap_type'           => 3
            ];
        });
    }
}
