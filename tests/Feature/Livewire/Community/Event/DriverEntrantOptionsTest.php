<?php

namespace Tests\Feature\Livewire\Community\Event;

use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToEventProposal;
use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Http\Livewire\Community\Event\DriverEntrantOptions;
use App\Models\Car;
use App\Models\RaceEvent;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class DriverEntrantOptionsTest extends TestCase
{
    /** @test */
    public function it_registers_the_authed_user_to_a_non_team_event()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->has($this->fullAccConfigFactory(false))->create();

        /** @var Car $car */
        $car = Car::first();
        $event->availableCars()->attach($car);
        $user = User::factory()->create();
        $event->community->members()->attach($user);
        $this->actingAs($user);
        $spy = $this->spy(RegisterUserToEventAction::class);


        Livewire::test(DriverEntrantOptions::class, ['event' => $event])
            ->set('input.selectedCar', $car->id)
            ->call('registerUser');


        $spy->shouldHaveReceived()->execute(RegisterUserToEventProposal::class);
        $proposal = app(RegisterUserToEventProposal::class);
        $this->assertTrue($proposal->user->is($user));
        $this->assertEquals($car->id, $proposal->carModelId);
        $this->assertTrue($proposal->community->is($event->community));
        $this->assertTrue($proposal->event->is($event));
    }

    /** @test */
    public function it_registers_the_authed_user_to_a_non_team_event_inputs_must_be_valid()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->has($this->fullAccConfigFactory(false))->create();
        /** @var Car $car */
        $car = Car::first();
        $event->availableCars()->attach($car);
        $user = User::factory()->create();
        $event->community->members()->attach($user);
        $this->actingAs($user);
        $spy = $this->spy(RegisterUserToEventAction::class);


        Livewire::test(DriverEntrantOptions::class, ['event' => $event])
            ->set('input.selectedCar', 'nonsense')
            ->call('registerUser')
            ->assertHasErrors('selectedCar');


        $spy->shouldNotHaveReceived()->execute(RegisterUserToEventProposal::class);
    }
}
