<?php

namespace Tests\Feature\Models;

use App\Models\AccConfig;
use App\Models\Community;
use App\Models\RaceEvent;
use App\Models\RaceEventEntry;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Tests\TestCase;

class RaceEventModelTest extends TestCase
{
    public $model = RaceEvent::class;

    /** @test */
    public function it_auto_validates_track()
    {
        $this->expectValidationException('track', 'throw error');
    }

    /** @test */
    public function it_has_many_race_event_entries()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()
            ->has(RaceEventEntry::factory()->count(2), 'entries')
            ->create();

        $this->assertCount(2, $event->entries);
        $this->assertInstanceOf(EloquentCollection::class, $event->entries);
    }

    /** @test */
    public function it_belongs_to_a_community()
    {
        RaceEvent::factory()->create();

        $event = RaceEvent::first();

        $this->assertInstanceOf(Community::class, $event->community);
    }

    /** @test */
    public function it_has_one_acc_config()
    {
        $event = RaceEvent::factory()->hasAccConfig()->create();
        $event->refresh();

        $this->assertInstanceOf(AccConfig::class, $event->accConfig);
    }
}
