<?php

namespace Tests\Feature\Livewire\CommunityAdmin\EventManagement;

use App\Models\RaceEvent;
use Tests\TestCase;

class AccEventSessionsTest extends TestCase
{
    /** @test */
    public function it_has_a_route()
    {
        $this->withoutExceptionHandling();
        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->has($this->fullAccConfigFactory(false))->create()->refresh();

        $response  = $this->get($event->adminEventSessionsLink());

        $response->assertOk();
    }
}
