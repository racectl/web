<?php

namespace Tests\Feature\Livewire\Community;

use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Actions\RegisterUserToEvent\RegisterUserToEventProposal;
use App\Models\Community;
use Livewire\Livewire;
use Tests\TestCase;

class Events extends TestCase
{
    /** @test */
    public function it_has_a_route()
    {
        $this->withoutExceptionHandling();
        /** @var Community $community */
        $community = Community::factory()->create()->refresh();

        $response  = $this->get($community->showEventsLink());

        $response->assertOk();
    }

    /** @test */
    public function it_shows_events()
    {
        /** @var Community $community */
        $community = Community::factory()->hasEvents(3)->create()->refresh()->load('events');

        $livewire = Livewire::test(\App\Http\Livewire\Community\Events::class, ['community' => $community]);

        foreach ($community->events as $event) {
            $livewire->assertsee($event->name);
        }
    }

    /** @test */
    public function it_can_quick_register_the_logged_in_user()
    {
        $spy = $this->spy(RegisterUserToEventAction::class);

        $loggedInUser = $this->logFirstUserIn();
        /** @var Community $community */
        $community = Community::factory()->hasEvents(1)->create()->refresh()->load('events');
        $community->members()->attach($loggedInUser);

        Livewire::test(\App\Http\Livewire\Community\Events::class, ['community' => $community])
            ->call('quickRegisterToEvent', $community->events->first()->id);

        $spy->shouldHaveReceived()->execute(RegisterUserToEventProposal::class);
    }
}
