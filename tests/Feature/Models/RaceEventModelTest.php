<?php

namespace Tests\Feature\Models;

use App\Models\AccConfig;
use App\Models\Community;
use App\Models\RaceEvent;
use App\Models\RaceEventEntry;
use App\Models\User;
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
        $event = RaceEvent::factory()->create();
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
    public function it_generates_a_link_to_admin_available_cars_management()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create();

        $expected = route(
            'communityAdmin.eventManagement.availableCars',
            [
                'community' => $event->community,
                'event' => $event
            ]
        );

        $this->assertEquals($expected, $event->adminAvailableCarsLink());
    }

    /** @test */
    public function it_generates_a_link_to_admin_event_session_management()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create();

        $expected = route(
            'communityAdmin.eventManagement.eventSessions',
            [
                'community' => $event->community,
                'event' => $event
            ]
        );

        $this->assertEquals($expected, $event->adminEventSessionsLink());
    }

    /** @test */
    public function it_generates_a_link_to_admin_event_config_settings()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create();

        $expected = route(
            'communityAdmin.eventManagement.configSettings',
            [
                'community' => $event->community,
                'event' => $event
            ]
        );

        $this->assertEquals($expected, $event->adminEventConfigSettingsLink());

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
    public function it_knows_if_a_user_is_registered_to_the_event()
    {
        /** @var RaceEvent $event */
        $event = Raceevent::factory()->has(
            RaceEventEntry::factory()->hasUsers(), 'entries'
        )->create();
        $user = $event->entries->first()->driver();

        $this->assertTrue($event->userIsRegistered($user));
    }

    /** @test */
    public function it_knows_if_the_authed_user_is_registered_to_the_event()
    {
        /** @var RaceEvent $event */
        $event = Raceevent::factory()->has(
            RaceEventEntry::factory()->hasUsers(), 'entries'
        )->create();
        $this->actingAs($event->entries->first()->driver());

        $this->assertTrue($event->userIsRegistered());
    }

    /** @test */
    public function it_knows_a_user_is_not_registered()
    {
        /** @var RaceEvent $event */
        $event = Raceevent::factory()->has(
            RaceEventEntry::factory()->hasUsers(), 'entries'
        )->create();
        $user = User::factory()->create();

        $this->assertFalse($event->userIsRegistered($user));
    }

    /** @test */
    public function it_gets_the_entry_for_a_user()
    {
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->hasEntries()->create();
        /** @var RaceEventEntry $entry */
        $entry = $event->entries->first();
        $user  = User::factory()->create();
        $entry->users()->attach($user);

        $found = $event->entryForUser($user);
        $this->assertTrue($found->is($entry));

        $this->actingAs($user);
        $found = $event->entryForUser();
        $this->assertTrue($found->is($entry));
    }
}
