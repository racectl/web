<?php

namespace Tests\Feature;

use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Actions\RegisterUserToEvent\RegisterUserToEventProposal;
use App\Exceptions\UserNotCommunityMemberException;
use App\Models\Community;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class RegisterUserToEventTest extends TestCase
{
    /** @test */
    public function it_registers_a_logged_in_user()
    {
        $user = $this->logFirstUserIn();
        $community = Community::first();
        $community->members()->attach($user);

        $createAction = App::make(CreateAccEventAction::class);
        $event = $createAction->execute($community, 'Testing Event');

        $proposal = new RegisterUserToEventProposal($event, 11);
        RegisterUserToEventAction::execute($proposal);

        $this->assertCount(1, $event->entries);
        $this->assertCount(1, $event->entries->first()->users);
    }

    /** @test */
    public function user_must_be_a_member_of_the_community()
    {
        $this->expectException(UserNotCommunityMemberException::class);

        $this->logFirstUserIn();
        $community = Community::first();

        $createAction = App::make(CreateAccEventAction::class);
        $event = $createAction->execute($community, 'Testing Event');

        $proposal = new RegisterUserToEventProposal($event, 11);
        RegisterUserToEventAction::execute($proposal);
    }
}
