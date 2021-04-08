<?php

namespace Tests\Feature\ActionPipelines;

use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Models\Community;
use App\Models\RaceEvent;
use App\Models\Track;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class CreateAccEventActionTest extends TestCase
{
    /** @test */
    public function it_creates_an_event_with_all_acc_config_entries()
    {
        Community::factory()->create();

        /** @var Community $community */
        $community = Community::first();

        $track = Track::acc()->get()->random();

        $createAction = app(CreateAccEventAction::class);
        $event = $createAction->execute($community, 'Event Name', $track->gameConfigId);

        $this->assertInstanceOf(RaceEvent::class, $event);
        $this->assertEquals($track->gameConfigId, $event->track);
        $this->assertDatabaseCount('race_events', 1);
        $this->assertDatabaseCount('acc_configs', 1);
        $this->assertDatabaseCount('acc_assist_rules', 4); //TODO: Fix these.
        $this->assertDatabaseCount('acc_events', 1);
        $this->assertDatabaseCount('acc_event_sessions', 1);
        $this->assertDatabaseCount('acc_event_rules', 1);
        $this->assertDatabaseCount('acc_settings', 1);
    }

}
