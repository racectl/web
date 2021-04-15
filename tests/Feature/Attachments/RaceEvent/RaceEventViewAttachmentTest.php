<?php

namespace Tests\Feature\Attachments\RaceEvent;

use App\Attachments\RaceEvent\RaceEventViewAttachment;
use App\Models\RaceEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RaceEventViewAttachmentTest extends TestCase
{
    /** @test */
    public function it_does_something()
    {
        /** @var RaceEvent $event */
        $event        = RaceEvent::factory()->create();
        $withAttached = new RaceEventViewAttachment($event);

        $expectedLink = route('community.event.show', [
            'community' => $event->community,
            'event'     => $event
        ]);

        $this->assertEquals($expectedLink,       $withAttached->showLink());
        $this->assertEquals($event->name,        $withAttached->name);
        $this->assertEquals($event->startDate(), $withAttached->startDate());
    }
}
