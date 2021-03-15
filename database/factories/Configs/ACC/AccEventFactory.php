<?php

namespace Database\Factories\Configs\ACC;

use App\Models\AccConfig;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Track;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'acc_config_id' => AccConfig::factory()
        ];
    }
}
