<?php

namespace Tests\Feature\ActionPipelines;

use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToEventProposal;
use App\Exceptions\UserAlreadyRegisteredToEventException;
use App\Exceptions\UserNotCommunityMemberException;
use App\Models\Community;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class RegisterUserToEventTest extends TestCase
{
    /** @test */
    public function it_registers_a_logged_in_user()
    {
        $this->withoutExceptionHandling();

        /** @var Community $community */
        $community = Community::factory()->create()->refresh();
        $user = User::factory()->create();
        $this->actingAs($user);
        $community->members()->attach($user);

        $createAction = App::make(CreateAccEventAction::class);
        $event = $createAction->execute($community, 'Testing Event');

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

        $community = Community::factory()->create()->refresh();
        $user = User::factory()->create();
        $this->actingAs($user);

        $createAction = App::make(CreateAccEventAction::class);
        $event = $createAction->execute($community, 'Testing Event');

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
        $community->members()->attach($user);

        $createAction = app(CreateAccEventAction::class);
        $event = $createAction->execute($community, 'Testing Event');

        $this->expectException(UserAlreadyRegisteredToEventException::class);
        $proposal = new RegisterUserToEventProposal($event, 11);
        $registrationAction = new RegisterUserToEventAction;
        $registrationAction->execute($proposal);
        $event->refresh();
        $registrationAction->execute($proposal);
    }
}
