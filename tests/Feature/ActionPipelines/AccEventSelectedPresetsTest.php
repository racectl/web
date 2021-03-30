<?php

namespace Tests\Feature\ActionPipelines;

use App\Actions\CreateAccEvent\AccEventSelectedPresets;
use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Models\Car;
use App\Models\Community;
use App\Models\Config\ACC\AccWeatherPreset;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AccEventSelectedPresetsTest extends TestCase
{

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

    /**
     * @test
     */
    public function it_can_create_with_a_weather_preset()
    {
        $weather = AccWeatherPreset::first();

        $community = Community::factory()->create()->refresh();
        /** @var AccEventSelectedPresets $presets */
        $presets = App::make(AccEventSelectedPresets::class);
        $presets->setWeatherFromId(1);

        $event       = CreateAccEventAction::execute($community, 'Event Name');
        $eventConfig = $event->accConfig->event;

        $checks = ['cloudLevel', 'rain', 'ambientTemp', 'weatherRandomness', 'simracerWeatherConditions', 'isFixedConditionQualification'];

        foreach ($checks as $check) {
            $this->assertEquals($weather->$check, $eventConfig->$check);
        }
    }
}
