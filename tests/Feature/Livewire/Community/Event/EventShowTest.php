<?php

namespace Tests\Feature\Livewire\Community\Event;

use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToEventProposal;
use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Http\Livewire\Community\Event\EventShow;
use App\Http\Livewire\Community\Event\TeamEntrantOptions;
use App\Models\Car;
use App\Models\RaceEvent;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class EventShowTest extends TestCase
{
    /** @test */
    public function it_shows_team_components_for_a_team_event()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->has($this->fullAccConfigFactory(false))->create([
            'team_event' => true
        ]);

        $this->actingAs(User::factory()->create());
        $event->availableCars()->attach(Car::first()->id);

        Livewire::test(EventShow::class, ['community' => $event->community, 'event' => $event])
            ->assertHasNoErrors();
    }
}
