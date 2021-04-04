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

    /** @test */
    public function it_generates_a_link_to_admin_availalbe_cars_management()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create();

        $expected = route(
            'communityAdmin.EventManagement.availableCars',
            [
                'community' => $event->community,
                'event' => $event
            ]
        );

        $this->assertEquals($expected, $event->adminAvailableCarsLink());
    }

    /** @test */
    public function it_generates_a_show_link()
    {
        /** @var RaceEvent $event */
        $event    = RaceEvent::factory()->create();
        $expected = route('community.event.show', [
            'community' => $event->community,
            'event' => $event
        ]);

        $this->assertEquals($expected, $event->showLink());
    }

    /** @test */
    public function it_has_registration_types()
    {
        //Need to think about how what's involved between single driver registrations and teams.
    }
}
