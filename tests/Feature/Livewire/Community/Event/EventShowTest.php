<?php

namespace Tests\Feature\Livewire\Community\Event;

use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Actions\RegisterUserToEvent\RegisterUserToEventProposal;
use App\Http\Livewire\Community\Event\EventShow;
use App\Models\Car;
use App\Models\RaceEvent;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class EventShowTest extends TestCase
{
    /** @test */
    public function it_registers_the_authed_user()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create();
        /** @var Car $car */
        $car = Car::first();
        $event->availableCars()->attach($car);
        $user = User::factory()->create();
        $event->community->members()->attach($user);
        $this->actingAs($user);
        $spy = $this->spy(RegisterUserToEventAction::class);


        Livewire::test(EventShow::class, ['community' => $event->community, 'event' => $event])
            ->set('input.selectedCar', $car->id)
            ->call('registerUser');


        $spy->shouldHaveReceived()->execute(RegisterUserToEventProposal::class);
        $proposal = app(RegisterUserToEventProposal::class);
        $this->assertTrue($proposal->user->is($user));
        $this->assertEquals($car->id, $proposal->carModelId);
        $this->assertTrue($proposal->community->is($event->community));
        $this->assertTrue($proposal->event->is($event));
    }
}
