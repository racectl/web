<?php

namespace Tests\Feature\ActionPipelines;

use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Models\AccConfig;
use App\Models\Community;
use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventRules;
use App\Models\Configs\ACC\AccSettings;
use App\Models\RaceEvent;
use App\Models\Track;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
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

        /** @var CreateAccEventAction $createAction */
        $createAction = app(CreateAccEventAction::class);
        $event        = $createAction->execute($community, 'Event Name', $track->gameConfigId);

        $this->assertInstanceOf(RaceEvent::class, $event);
        $this->assertEquals($track->gameConfigId, $event->track);
        $this->assertInstanceOf(AccConfig::class, $event->accConfig);

        $config = $event->accConfig;
        $this->assertInstanceOf(AccAssistRules::class,     $config->assistRules);
        $this->assertInstanceOf(AccEvent::class,           $config->event);
        $this->assertInstanceOf(AccEventRules::class,      $config->eventRules);
        $this->assertInstanceOf(AccSettings::class,        $config->settings);
        $this->assertInstanceOf(EloquentCollection::class, $config->globalBops);
        $this->assertCount     (1,                     $config->event->accEventSessions);

    }

}
