<?php

namespace Database\Factories;

use App\Models\RaceEvent;
use App\Models\Track;
use Illuminate\Database\Eloquent\Factories\Factory;

class RaceEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RaceEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'force_entry_list' => 1,
            'track' => $this->trackConfigId()
        ];
    }

    protected function trackConfigId()
    {
        return Track::select('game_config_id')->get()->random()->gameConfigId;
    }
}
