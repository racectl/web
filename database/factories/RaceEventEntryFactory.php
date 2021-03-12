<?php

namespace Database\Factories;

use App\Models\RaceEvent;
use App\Models\RaceEventEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

class RaceEventEntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RaceEventEntry::class;

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
