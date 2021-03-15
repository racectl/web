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
        Community::factory()->hasEvents(3)->create();

        $community = Community::first();

        $this->assertCount(3, $community->events);
    }
}
