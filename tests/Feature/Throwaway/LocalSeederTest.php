<?php

namespace Tests\Feature\Throwaway;

use App\Models\AccConfig;
use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventRules;
use App\Models\Configs\ACC\AccSettings;
use App\Models\RaceEvent;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Tests\TestCase;

class LocalSeederTest extends TestCase
{
    /** @test */
    public function it_seeds()
    {
        $event = RaceEvent::find(1);
        $this->assertInstanceOf(RaceEvent::class,     $event);
        $this->assertEquals    ('Individual Drivers', $event->name);
        $this->assertInstanceOf(AccConfig::class,     $event->accConfig);
        $config = $event->accConfig;

        $this->assertInstanceOf(AccAssistRules::class,     $config->assistRules);
        $this->assertInstanceOf(AccEvent::class,           $config->event);
        $this->assertInstanceOf(AccEventRules::class,      $config->eventRules);
        $this->assertInstanceOf(AccSettings::class,        $config->settings);
        $this->assertInstanceOf(EloquentCollection::class, $config->globalBops);
        $this->assertCount     (3,                     $config->event->accEventSessions);


        $event = RaceEvent::find(2);
        $this->assertInstanceOf(RaceEvent::class, $event);
        $this->assertEquals    ('Driver Teams',   $event->name);
        $this->assertInstanceOf(AccConfig::class, $event->accConfig);
        $config = $event->accConfig;

        $this->assertInstanceOf(AccAssistRules::class,     $config->assistRules);
        $this->assertInstanceOf(AccEvent::class,           $config->event);
        $this->assertInstanceOf(AccEventRules::class,      $config->eventRules);
        $this->assertInstanceOf(AccSettings::class,        $config->settings);
        $this->assertInstanceOf(EloquentCollection::class, $config->globalBops);
        $this->assertCount     (3,                     $config->event->accEventSessions);
    }
}
