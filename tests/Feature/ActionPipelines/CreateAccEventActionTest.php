<?php

namespace Tests\Feature\ActionPipelines;

use App\Actions\CreateAccEvent\AccEventSelectedPresets;
use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Models\Car;
use App\Models\Community;
use App\Models\RaceEvent;
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

    /** @test */
    public function it_can_create_with_a_default_gt3_car_list()
    {
        $community = Community::factory()->create()->refresh();
        /** @var AccEventSelectedPresets $presets */
        $presets                = App::make(AccEventSelectedPresets::class);
        $presets->availableCars = 'accGt3s';
        $expectedCount          = Car::whereType('GT3')->whereSim('acc')->count();

        $event = CreateAccEventAction::execute($community, 'Event Name');

        $this->assertCount($expectedCount, $event->availableCars);
        $this->assertCount($expectedCount, $event->availableCars->where('type', 'GT3'));
    }

    /** @test */
    public function it_can_create_with_a_default_gt4_car_list()
    {
        $community = Community::factory()->create()->refresh();
        /** @var AccEventSelectedPresets $presets */
        $presets                = App::make(AccEventSelectedPresets::class);
        $presets->availableCars = 'accGt4s';
        $expectedCount          = Car::whereType('GT4')->whereSim('acc')->count();

        $event = CreateAccEventAction::execute($community, 'Event Name');

        $this->assertCount($expectedCount, $event->availableCars);
        $this->assertCount($expectedCount, $event->availableCars->where('type', 'GT4'));
    }
}
