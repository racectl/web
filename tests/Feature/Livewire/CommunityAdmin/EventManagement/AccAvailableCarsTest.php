<?php

namespace Tests\Feature\Livewire\CommunityAdmin\EventManagement;

use App\Http\Livewire\CommunityAdmin\EventManagement\AccAvailableCars;
use App\Models\Car;
use App\Models\RaceEvent;
use Livewire\Livewire;
use Tests\TestCase;

class AccAvailableCarsTest extends TestCase
{
    /** @test */
    public function it_has_a_route()
    {
        $this->withoutExceptionHandling();
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create()->refresh();

        $response  = $this->get($event->adminAvailableCarsLink());

        $response->assertOk();
    }

    /** @test */
    public function car_to_add_must_be_valid()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create()->refresh();

        Livewire::test(AccAvailableCars::class, [
            'community' => $event->community,
            'event' => $event
        ])
            ->set('input.carToAdd', 'fail')
            ->call('addAvailableCar')
            ->assertHasErrors('carToAdd');
    }

    /** @test */
    public function it_adds_a_car_to_event()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create()->refresh();
        $carToAdd = Car::acc()->first();

        Livewire::test(AccAvailableCars::class, [
                'community' => $event->community,
                'event' => $event
            ])
            ->set('input.carToAdd', $carToAdd->id)
            ->call('addAvailableCar')
            ->assertHasNoErrors();

        $this->assertTrue(
            $event->load('availableCars')->availableCars->contains($carToAdd)
        );
    }

    /** @test */
    public function it_removes_a_car_from_an_event()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create()->refresh();
        $carToRemove = Car::find(3);
        $event->availableCars()->attach($carToRemove);

        $this->assertTrue(
            $event->load('availableCars')->availableCars->contains($carToRemove)
        );

        Livewire::test(AccAvailableCars::class, [
            'community' => $event->community,
            'event' => $event
        ])
            ->call('setCarToRemove', $carToRemove->id)
            ->assertHasNoErrors();

        $this->assertFalse(
            $event->load('availableCars')->availableCars->contains($carToRemove)
        );
    }

    /** @test */
    public function car_to_remove_must_be_valid()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create()->refresh();

        Livewire::test(AccAvailableCars::class, [
            'community' => $event->community,
            'event' => $event
        ])
            ->call('setCarToRemove', 'fail')
            ->assertHasErrors('carToRemove');
    }
}
