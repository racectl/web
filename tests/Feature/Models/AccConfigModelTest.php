<?php


namespace Tests\Feature\Models;


use App\Models\AccConfig;
use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Configs\ACC\AccBop;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventRules;
use App\Models\Configs\ACC\AccEventSession;
use App\Models\Configs\ACC\AccSettings;
use App\Models\RaceEvent;
use App\Models\RaceEventEntry;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class AccConfigModelTest extends \Tests\TestCase
{
    /** @test */
    public function a_full_factory_can_be_built()
    {
        /** @var AccConfig $config */
        $config = $this->fullAccConfigFactory();

        $this->assertInstanceOf(AccAssistRules::class, $config->assistRules);
        $this->assertInstanceOf(AccEvent::class, $config->event);
        $this->assertInstanceOf(AccEventRules::class, $config->eventRules);
        $this->assertInstanceOf(AccSettings::class, $config->settings);
        $this->assertInstanceOf(EloquentCollection::class, $config->globalBops);
        $this->assertCount(3, $config->event->accEventSessions);
    }

    /** @test */
    public function it_loads_all_relationships()
    {
        /** @var AccConfig $config */
        $config = AccConfig::factory()->create();
        $this->assertCount(0, $config->getRelations());


        $config->loadAllConfigs();


        $this->assertGreaterThan(0, $config->getRelations());
    }

    /** @test */
    public function it_belongs_to_race_event()
    {
        $raceEvent = RaceEvent::factory()->create();
        $config = AccConfig::factory()->for($raceEvent)->create();

        $this->assertInstanceOf(RaceEvent::class, $config->raceEvent);
    }

    /** @test */
    public function it_gets_an_entry_list()
    {
        /** @var AccConfig $config */
        $config = AccConfig::factory()->for(
            RaceEvent::factory()->has(
                RaceEventEntry::factory()->count(3)->hasUsers(1),
                'entries'
            )
        )->create();

        $this->assertJson($config->entryListJson());
    }
}
