<?php

namespace Tests\Feature\ActionPipelines;

use App\Actions\RegisterUserToEvent\Proposals\RegisterNewTeamAndUserToEventProposal;
use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToEventProposal;
use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToExistingTeamProposal;
use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Exceptions\UserAlreadyRegisteredToEventException;
use App\Exceptions\UserNotCommunityMemberException;
use App\Models\Community;
use App\Models\RaceEvent;
use App\Models\RaceEventEntry;
use App\Models\User;
use Tests\TestCase;

class RegisterUserToEventTest extends TestCase
{
    /** @test */
    public function it_registers_a_logged_in_user()
    {
        $this->withoutExceptionHandling();

        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create();
        $user  = User::factory()->create();
        $this->actingAs($user);
        $event->community->members()->attach($user);

        $proposal = new RegisterUserToEventProposal($event, 11);
        $registrationAction = new RegisterUserToEventAction;
        $registrationAction->execute($proposal);

        $this->assertCount(1, $event->refresh()->entries);
        $this->assertCount(1, $event->entries->first()->users);
    }

    /** @test */
    public function user_must_be_a_member_of_the_community()
    {
        $this->expectException(UserNotCommunityMemberException::class);

        /** @var RaceEvent $event */
        $event     = RaceEvent::factory()->create();
        $user      = User::factory()->create();
        $this->actingAs($user);

        $proposal = new RegisterUserToEventProposal($event, 11);
        $registrationAction = new RegisterUserToEventAction;
        $registrationAction->execute($proposal);
    }

    /** @test */
    public function a_user_can_not_have_two_registrations()
    {
        $this->withoutExceptionHandling();

        $community = Community::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create();
        $event->community->members()->attach($user);

        $this->expectException(UserAlreadyRegisteredToEventException::class);
        $proposal = new RegisterUserToEventProposal($event, 11);
        $registrationAction = new RegisterUserToEventAction;
        $registrationAction->execute($proposal);
        $event->refresh();
        $registrationAction->execute($proposal);
    }

    /** @test */
    public function it_creates_a_team_and_registers_the_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create();
        $event->community->members()->attach($user);

        $proposal = new RegisterNewTeamAndUserToEventProposal(
            $event,
            11,
            'Team Name'
        );

        $registrationAction = new RegisterUserToEventAction;
        $registrationAction->execute($proposal);

        $this->assertCount(1, $event->load('entries')->entries);
        $entry = $event->entries->first();
        $this->assertEquals('Team Name', $entry->teamName);
        $this->assertCount(1, $entry->users);
        $this->assertTrue($entry->users->first()->is($user));
        $this->assertNotNull($entry->teamJoinCode);
    }


    /** @test */
    public function it_adds_a_user_to_a_team()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create();
        $event->community->members()->attach($user);
        $existingUser = User::factory()->create();
        /** @var RaceEventEntry $entry */
        $entry = RaceEventEntry::factory()->make();
        $entry->generateTeamJoinCode();
        $event->entries()->save($entry);
        $entry->users()->attach($existingUser);


        $proposal = new RegisterUserToExistingTeamProposal(
            $event,
            $entry->teamJoinCode
        );
        $registrationAction = new RegisterUserToEventAction;
        $registrationAction->execute($proposal);


        $this->assertCount(2, $entry->load('users')->users);
        $this->assertTrue($entry->users->contains($user));
    }
}
