<?php

namespace Tests\Feature\Livewire\CommunityAdmin\EventManagement;

use App\Http\Livewire\CommunityAdmin\EventManagement\ConfigSettings;
use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventRules;
use App\Models\Configs\ACC\AccSettings;
use App\Models\RaceEvent;
use Livewire\Livewire;
use Tests\TestCase;

class ConfigSettingsTest extends TestCase
{
    /** @test */
    public function it_has_a_route()
    {
        $this->withoutExceptionHandling();
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->has($this->fullAccConfigFactory(false))->create()->refresh();

        $response  = $this->get($event->adminEventConfigSettingsLink());

        $response->assertOk();
    }

    /** @test */
    public function it_binds_all_inputs()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->has($this->fullAccConfigFactory(false))->create()->refresh();
        $config = $event->accConfig;

        $testable = Livewire::test(ConfigSettings::class, [
            'community' => $event->community,
            'event' => $event
        ]);
        /** @var ConfigSettings $class */
        $class = $testable->instance();

        $models = [
            'assistRules' => AccAssistRules::class,
            'event' => AccEvent::class,
            'eventRules' => AccEventRules::class,
            'settings' => AccSettings::class
        ];

        $shouldNotHave = collect(['metaData',
                                  'configVersion',
                                  'serverName',
                                  'carGroup',
                                  'trackMedalsRequirement',
                                  'safetyRatingRequirement',
                                  'racecraftRatingRequirement',
                                  'maxCarSlots',
                                  'dumpLeaderboards',
                                  'isRaceLocked',
                                  'randomizeTrackWhenEmpty',
                                  'centralEntryListPath',
                                  'dumpEntryList']);

        foreach ($shouldNotHave as $property) {
            $this->assertArrayNotHasKey($property, $class->input);
        }


        foreach ($models as $configProp => $model) {
            foreach ($model::rules() as $property => $null) {
                if (! $shouldNotHave->contains($property) ) {
                    $this->assertArrayHasKey($property, $class->rulesForTesting(), 'Missing From Rules.');
                    $this->assertEquals($config->$configProp->$property, $class->input[$property], 'Missing Input.');
                }
            }
        }

        $this->assertArrayHasKey('name', $class->rulesForTesting(), 'Missing From Rules.');
        $this->assertEquals($event->name, $class->input['name'], 'Missing Input');

        $this->assertArrayHasKey('track', $class->rulesForTesting(), 'Missing From Rules.');
        $this->assertEquals($event->track, $class->input['track'], 'Missing Input.');
    }
}
