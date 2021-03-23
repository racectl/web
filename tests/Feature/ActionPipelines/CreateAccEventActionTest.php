<?php

namespace Tests\Feature\ActionPipelines;

use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Models\Community;
use App\Models\RaceEvent;
use Tests\TestCase;

class CreateAccEventActionTest extends TestCase
{
    /** @test */
    public function it_creates_an_event_with_all_acc_config_entries()
    {
        $this->assertTrue(true);
        Community::factory()->create();

        /** @var Community $community */
        $community = Community::first();

        $actionReturn = CreateAccEventAction::execute($community, 'Event Name');

        $this->assertInstanceOf(RaceEvent::class, $actionReturn);
        $this->assertDatabaseCount('race_events', 1);
        $this->assertDatabaseCount('acc_configs', 1);
        $this->assertDatabaseCount('acc_assist_rules', 1);
        $this->assertDatabaseCount('acc_events', 1);
        $this->assertDatabaseCount('acc_event_sessions', 1);
        $this->assertDatabaseCount('acc_event_rules', 1);
        $this->assertDatabaseCount('acc_settings', 1);
    }
}
