<?php

namespace Tests\Feature;

use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Actions\RegisterUserToEvent\RegisterUserToEventProposal;
use App\Models\Community;
use App\Models\RaceEventEntry;
use Tests\TestCase;

class RegisterUserToEventTest extends TestCase
{
    /** @test */
    public function it_registers_a_logged_in_user()
    {
        $this->logFirstUserIn();
        $community = Community::first();
        $event = CreateAccEventAction::execute($community, 'Testing Event');

        $proposal = new RegisterUserToEventProposal($event, 11);
        RegisterUserToEventAction::execute($proposal);

        $this->assertDatabaseCount('race_event_entries', 1);
        $this->assertDatabaseCount('race_event_entry_user', 1);
    }
}
