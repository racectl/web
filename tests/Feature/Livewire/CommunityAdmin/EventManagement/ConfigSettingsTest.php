<?php

namespace Tests\Feature\Livewire\CommunityAdmin\EventManagement;

use App\Http\Livewire\CommunityAdmin\EventManagement\ConfigSettings;
use App\Models\AccConfig;
use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventRules;
use App\Models\Configs\ACC\AccSettings;
use App\Models\RaceEvent;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class ConfigSettingsTest extends TestCase
{
    protected $shouldNotHave;

    protected function setUp(): void
    {
        parent::setUp();
        $this->shouldNotHave =
            collect([
                'id',
                'metaData',
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
                'dumpEntryList',
                'acc_config_id',
                'server_name',
                'car_group',
                'safety_rating_requirement',
                'racecraft_rating_requirement',
                'track_medals_requirement',
                'max_car_slots',
                'dump_leaderboards',
                'is_race_locked',
                'randomize_track_when_empty',
                'central_entry_list_path',
                'dump_entry_list',
            ]);
    }

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

        foreach ($this->shouldNotHave as $property) {
            $this->assertArrayNotHasKey($property, $class->input);
        }


        foreach ($models as $configProp => $model) {
            foreach ($model::rules() as $property => $null) {
                if (! $this->shouldNotHave->contains($property) ) {
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

    /**
     * @test
     * This test could provide false positives because the full race event factories could spit out the
     * same values for some properties. I'm confident that the code being tested is written in a way that
     * it wouldn't matter.
     */
    public function it_saves()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->has($this->fullAccConfigFactory(false))->create()->refresh();

        $testable = Livewire::test(ConfigSettings::class, [
            'community' => $event->community,
            'event' => $event
        ]);
        $class = $testable->instance();

        //list of the relationship names and classes on accConfig model.
        $models = [
            'assistRules' => AccAssistRules::class,
            'event' => AccEvent::class,
            'eventRules' => AccEventRules::class,
            'settings' => AccSettings::class
        ];

        //get all properties that should be assigned to inputs in livewire component.
        $props['assistRulesProps'] = array_keys(AccAssistRules::rules());
        $props['accEventProps'] = array_keys(Arr::except(AccEvent::rules(), ['metaData', 'configVersion']));
        $props['eventRulesProps'] = array_keys(AccEventRules::rules());
        $props['accSettingsProps'] = ['adminPassword', 'password', 'spectatorPassword', 'allowAutoDQ', 'shortFormationLap', 'formationLapType'];
        $props['raceEventProps'] = ['name', 'track'];

        //make a fake set of data to assign values to save to the one being tested.
        /** @var RaceEvent $eventToCopyFrom */
        $eventToCopyFrom = RaceEvent::factory()->has($this->fullAccConfigFactory(false))->create()->refresh();
        $configToCopyFrom = $eventToCopyFrom->accConfig;

        //flat list of all key/value combinations.
        $expected = [];
        foreach (array_keys($models) as $configProp) {
            $expected = array_merge($expected, $configToCopyFrom->$configProp->getAttributes());
        }
        $expected = array_merge($expected, Arr::only($eventToCopyFrom->getAttributes(), ['name', 'track']));

        //set all properties from the fake set to the one being tested.
        foreach (Arr::flatten($props) as $property) {
            $testable->set(
                'input.' . $property,
                $expected[Str::snake($property)]
            );
        }

        //Double check we didn't add ones that shouldn't be there
        foreach ($this->shouldNotHave as $property) {
            $this->assertArrayNotHasKey($property, $class->input);
        }

        //What's actually being tested.
        $testable->assertHasNoErrors()->call('save');
        ////////////////////////////////////////////////////


        $event->refresh();
        $actual = [];
        foreach (array_keys($models) as $configProp) {
            $actual = array_merge($actual, $event->accConfig->$configProp->getAttributes());
        }
        $actual = array_merge($actual, Arr::only($event->getAttributes(), ['name', 'track']));

        //remove properties that aren't being tested for change.
        foreach ($this->shouldNotHave as $key) {
            unset(
                $expected[$key],
                $actual[$key]
            );
        }

        $this->assertEquals($expected, $actual);
    }
}
