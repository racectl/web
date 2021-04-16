<?php

namespace Database\Seeders;

use App\Models\AccConfig;
use App\Models\Car;
use App\Models\Community;
use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Configs\ACC\AccBop;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventRules;
use App\Models\Configs\ACC\AccEventSession;
use App\Models\Configs\ACC\AccSettings;
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
        $community = Community::first();

        /** @var RaceEvent $event */
        $event = RaceEvent::factory()
            ->has($this->fullFactory())
            ->create([
                'team_event' => 0,
                'community_id' => 1,
                'name' => 'Individual Drivers'
            ]);
        foreach (Car::accGt3s()->get() as $car) {
            $event->availableCars()->attach($car);
        }

        /** @var RaceEvent $eventTwo */
        $eventTwo = RaceEvent::factory()
            ->has($this->fullFactory())
            ->create([
                'team_event' => 1,
                'community_id' => 1,
                'name' => 'Driver Teams'
            ]);
        foreach (Car::accGt3s()->get() as $car) {
            $eventTwo->availableCars()->attach($car);
        }

        //Create team for event two with one driver.
        $user = User::factory()->create();
        $community->members()->attach($user);
        $entry = new RaceEventEntry;
        $entry->generateTeamJoinCode();
        $eventTwo->entries()->save($entry);
        $entry->users()->attach($user);

        //Two More Users
        $users = User::factory()->count(2)->create();

        $community->members()->attach($users);
    }

    protected function fullFactory()
    {
        return AccConfig::factory()
            ->has(AccAssistRules::factory(), 'assistRules')
            ->has(
                AccEvent::factory()->has(
                    AccEventSession::factory()->count(3), 'accEventSessions'
                ),
                'event'
            )
            ->has(AccEventRules::factory(), 'eventRules')
            ->has(AccSettings::factory(), 'settings')
            ->has(AccBop::factory(), 'globalBops');
    }
}
