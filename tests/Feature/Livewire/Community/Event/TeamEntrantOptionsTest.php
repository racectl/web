<?php

namespace Tests\Feature\Livewire\Community\Event;

use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToEventProposal;
use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Http\Livewire\Community\Event\TeamEntrantOptions;
use App\Models\Car;
use App\Models\RaceEvent;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class TeamEntrantOptionsTest extends TestCase
{
    /** @test */
    public function it_registers_a_new_team()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->has($this->fullAccConfigFactory(false))->create([
            'team_event' => true
        ]);
        /** @var Car $car */
        $car = Car::first();
        $event->availableCars()->attach($car);
        $user = User::factory()->create();
        $event->community->members()->attach($user);
        $this->actingAs($user);
        $spy = $this->spy(RegisterUserToEventAction::class);

        Livewire::test(TeamEntrantOptions::class, ['event' => $event])
            ->set('input.selectedCar', $car->id)
            ->set('input.teamName', 'A Team Name')
            ->call('registerNewTeam');

        $spy->shouldHaveReceived()->execute(RegisterUserToEventProposal::class);
        $proposal = app(RegisterUserToEventProposal::class);
        $this->assertTrue($proposal->user->is($user));
        $this->assertEquals($car->id, $proposal->carModelId);
        $this->assertTrue($proposal->community->is($event->community));
        $this->assertTrue($proposal->event->is($event));
        $this->assertTrue($proposal->createNewTeam);
        $this->assertEquals('A Team Name', $proposal->teamName);
    }

    /** @test */
    public function it_joins_a_user_to_an_existing_team()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->has($this->fullAccConfigFactory(false))->create([
            'team_event' => true
        ]);
        /** @var Car $car */
        $car = Car::first();
        $event->availableCars()->attach($car);
        $user = User::factory()->create();
        $event->community->members()->attach($user);
        $this->actingAs($user);
        $spy = $this->spy(RegisterUserToEventAction::class);

        Livewire::test(TeamEntrantOptions::class, ['event' => $event])
            ->set('input.teamJoinCode', 'loremipsum')
            ->call('joinTeam');

        $spy->shouldHaveReceived()->execute(RegisterUserToEventProposal::class);
        $proposal = app(RegisterUserToEventProposal::class);
        $this->assertTrue($proposal->user->is($user));
        $this->assertTrue($proposal->community->is($event->community));
        $this->assertTrue($proposal->event->is($event));
        $this->assertEquals('loremipsum', $proposal->joinTeamCode);
    }

    /**
     * @test
     * Both validations are working, it only returns the first fail.
     */
    public function it_registers_a_new_team_inputs_must_be_valid()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->has($this->fullAccConfigFactory(false))->create([
            'team_event' => true
        ]);
        /** @var Car $car */
        $car = Car::first();
        $event->availableCars()->attach($car);
        $user = User::factory()->create();
        $event->community->members()->attach($user);
        $this->actingAs($user);
        $spy = $this->spy(RegisterUserToEventAction::class);

        Livewire::test(TeamEntrantOptions::class, ['event' => $event])
            ->set('input.selectedCar', 'nonsense')
            ->set('input.teamName', '')
            ->call('registerNewTeam')
            ->assertHasErrors(['teamName']);

        $spy->shouldNotHaveReceived()->execute(RegisterUserToEventProposal::class);
    }

    /** @test */
    public function it_joins_a_user_to_an_existing_team_inputs_must_be_valid()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->has($this->fullAccConfigFactory(false))->create([
            'team_event' => true
        ]);
        /** @var Car $car */
        $car = Car::first();
        $event->availableCars()->attach($car);
        $user = User::factory()->create();
        $event->community->members()->attach($user);
        $this->actingAs($user);
        $spy = $this->spy(RegisterUserToEventAction::class);

        Livewire::test(TeamEntrantOptions::class, ['event' => $event])
            ->set('input.teamJoinCode', '')
            ->call('joinTeam')
            ->assertHasErrors(['teamJoinCode']);

        $spy->shouldNotHaveReceived()->execute(RegisterUserToEventProposal::class);
    }
}
