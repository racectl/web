<?php

namespace Tests\Feature\Models;

use App\Models\Community;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommunityModelTest extends TestCase
{
    /** @test */
    public function it_has_many_events()
    {
        $community = Community::factory()->hasEvents(3)->create()->refresh();

        $this->assertCount(3, $community->events);
    }
}
