<?php

namespace Database\Factories;

use App\Models\AccConfig;
use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventRules;
use App\Models\Configs\ACC\AccEventSession;
use App\Models\Configs\ACC\AccSettings;
use App\Models\RaceEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccConfigFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccConfig::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'race_event_id' => RaceEvent::factory()
        ];
    }
}
