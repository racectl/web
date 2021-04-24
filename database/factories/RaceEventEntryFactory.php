<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\RaceEvent;
use App\Models\RaceEventEntry;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
            'race_event_id' => RaceEvent::factory(),
            'forced_car_model' => $this->randomCarId()
        ];
    }

    protected function randomCarId()
    {
         $ids = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25,
                 50, 51, 52, 53, 55, 56, 57, 58, 59, 60, 61];

         return Arr::random($ids);
    }
}
