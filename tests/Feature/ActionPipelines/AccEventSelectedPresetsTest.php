<?php

namespace Tests\Feature\ActionPipelines;

use App\Actions\CreateAccEvent\AccEventSelectedPresets;
use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Exceptions\InvalidCarPresetException;
use App\Models\Car;
use App\Models\Community;
use App\Models\Config\ACC\AccWeatherPreset;
use App\Models\Configs\ACC\AccAssistRules;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AccEventSelectedPresetsTest extends TestCase
{
    /** @test */
    public function it_can_create_with_a_gt3_preset()
    {
        $community = Community::factory()->create()->refresh();
        /** @var AccEventSelectedPresets $presets */
        $presets                = App::make(AccEventSelectedPresets::class);
        $presets->availableCars = 'accGt3s';
        $expectedCount          = Car::whereType('GT3')->whereSim('acc')->count();

        $createAction = App::make(CreateAccEventAction::class);
        $event        = $createAction->execute($community, 'Event Name');

        $this->assertCount($expectedCount, $event->availableCars);
        $this->assertCount($expectedCount, $event->availableCars->where('type', 'GT3'));
    }

    /** @test */
    public function it_can_create_with_a_gt4_preset()
    {
        $community = Community::factory()->create()->refresh();
        /** @var AccEventSelectedPresets $presets */
        $presets                = App::make(AccEventSelectedPresets::class);
        $presets->availableCars = 'accGt4s';
        $expectedCount          = Car::whereType('GT4')->whereSim('acc')->count();

        $createAction = App::make(CreateAccEventAction::class);
        $event        = $createAction->execute($community, 'Event Name');

        $this->assertCount($expectedCount, $event->availableCars);
        $this->assertCount($expectedCount, $event->availableCars->where('type', 'GT4'));
    }

    /** @test */
    public function it_can_create_with_a_gt3_and_gt4s_preset()
    {
        $community = Community::factory()->create()->refresh();
        /** @var AccEventSelectedPresets $presets */
        $presets                = App::make(AccEventSelectedPresets::class);
        $presets->availableCars = 'accGt3sAndGt4s';
        $expectedCount          = Car::where('type', 'GT3')
            ->orWhere('type', 'GT4')
            ->count();

        $createAction = App::make(CreateAccEventAction::class);
        $event        = $createAction->execute($community, 'Event Name');

        $this->assertCount($expectedCount, $event->availableCars);
    }

    /** @test */
    public function it_can_create_with_a_all_cars_preset()
    {
        $community = Community::factory()->create()->refresh();
        /** @var AccEventSelectedPresets $presets */
        $presets                = App::make(AccEventSelectedPresets::class);
        $presets->availableCars = 'accAll';
        $expectedCount          = Car::where('sim', 'acc')->count();

        $createAction = App::make(CreateAccEventAction::class);
        $event        = $createAction->execute($community, 'Event Name');

        $this->assertCount($expectedCount, $event->availableCars);
    }

    /** @test */
    public function car_preset_must_be_valid()
    {
        $this->expectException(InvalidCarPresetException::class);

        $community = Community::factory()->create()->refresh();
        /** @var AccEventSelectedPresets $presets */
        $presets                = App::make(AccEventSelectedPresets::class);
        $presets->availableCars = 'nonsense';

        $createAction = App::make(CreateAccEventAction::class);
        $event        = $createAction->execute($community, 'Event Name');
    }

    /** @test */
    public function it_can_create_with_a_weather_preset()
    {
        $weather = AccWeatherPreset::first();

        $community = Community::factory()->create()->refresh();
        /** @var AccEventSelectedPresets $presets */
        $presets = App::make(AccEventSelectedPresets::class);
        $presets->setWeatherFromId(1);

        $createAction = App::make(CreateAccEventAction::class);
        $event        = $createAction->execute($community, 'Event Name');
        $eventConfig  = $event->accConfig->event;

        $checks = ['cloudLevel', 'rain', 'ambientTemp', 'weatherRandomness', 'simracerWeatherConditions', 'isFixedConditionQualification'];

        foreach ($checks as $check) {
            $this->assertEquals($weather->$check, $eventConfig->$check);
        }
    }

    /** @test */
    public function it_can_create_with_an_assist_rules_preset()
    {
        $community = Community::factory()->create()->refresh();
        /** @var AccEventSelectedPresets $presets */
        $presets = App::make(AccEventSelectedPresets::class);
        $presets->setAssistRulesFromId(1);
        $preset = AccAssistRules::find(1);

        $createAction = App::make(CreateAccEventAction::class);
        $event        = $createAction->execute($community, 'Event Name');
        $actual  = $event->accConfig->assistRules;

        $checks = ['stabilityControlLevelMax', 'disableAutosteer', 'disableAutoLights', 'disableAutoWiper', 'disableAutoEngineStart', 'disableAutoPitLimiter', 'disableAutoGear', 'disableAutoClutch', 'disableIdealLine'];

        foreach ($checks as $check) {
            $this->assertEquals($preset->$check, $actual->$check);
        }
    }
}
