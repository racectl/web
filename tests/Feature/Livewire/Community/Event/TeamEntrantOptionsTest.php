<?php

namespace Tests\Feature\Livewire\Community\Event;

use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToEventProposal;
use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Http\Livewire\Community\Event\TeamEntrantOptions;
use App\Models\Car;
use App\Models\RaceEvent;
use App\Models\RaceEventEntry;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

    /** @test */
    public function it_withdraws_a_team()
    {
        $userOne = User::factory()->create();
        $userTwo = User::factory()->create();

        /** @var RaceEventEntry $entry */
        $entry = RaceEventEntry::factory()->make();
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create();
        $event->entries()->save($entry);
        $event->availableCars()->attach(1);

        $entry->users()->attach($userOne);
        $entry->users()->attach($userTwo);

        $existingEntryCount = RaceEventEntry::count();
        $existingPivotCount = DB::table('race_event_entry_user')->count();

        $this->actingAs($userOne);
        $testable = Livewire::test(TeamEntrantOptions::class, ['event' => $event])
            ->call('withdrawTeam');
        $instance = $testable->instance();

        $this->assertDatabaseCount('race_event_entries', $existingEntryCount - 1);
        $this->assertDatabaseCount('race_event_entry_user', $existingPivotCount - 2);
        $this->assertNull($instance->authEntry);
    }

    /** @test */
    public function it_withdraws_a_user_from_a_team()
    {
        $userOne = User::factory()->create();
        $userTwo = User::factory()->create();

        /** @var RaceEventEntry $entry */
        $entry = RaceEventEntry::factory()->make();
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create();
        $event->entries()->save($entry);
        $event->availableCars()->attach(1);

        $entry->users()->attach($userOne);
        $entry->users()->attach($userTwo);

        $this->actingAs($userTwo);
        $testable = Livewire::test(TeamEntrantOptions::class, ['event' => $event])
            ->call('leaveTeam');

        $this->assertFalse($entry->refresh()->users->contains($userTwo));
    }
}
