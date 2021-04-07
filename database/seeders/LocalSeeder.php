<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\RaceEvent;
use App\Models\RaceEventEntry;
use App\Models\User;
use Illuminate\Database\Seeder;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create([
            'team_event' => 0,
            'community_id' => 1,
            'name' => 'Individual Drivers'
        ]);
        foreach (Car::accGt3s()->get() as $car) {
            $event->availableCars()->attach($car);
        }

        /** @var RaceEvent $eventTwo */
        $eventTwo = RaceEvent::factory()->create([
            'team_event' => 1,
            'community_id' => 1,
            'name' => 'Driver Teams'
        ]);
        foreach (Car::accGt3s()->get() as $car) {
            $eventTwo->availableCars()->attach($car);
        }

        //Create team for event two with one driver.
        $user = User::factory()->create();
        $entry = new RaceEventEntry;
        $entry->generateTeamJoinCode();
        $eventTwo->entries()->save($entry);
        $entry->users()->attach($user);

        //Two More Users
        User::factory()->count(2)->create();
    }
}
