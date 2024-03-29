<?php

namespace Tests\Feature\Models;

use App\Models\Community;
use App\Models\User;
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

    /** @test */
    public function it_has_a_many_to_many_with_users_called_members()
    {
        $community = Community::factory()->hasMembers(3)->create()->refresh();

        $this->assertCount(3, $community->members);
    }

    /** @test */
    public function it_adds_a_user_to_members()
    {
        $user = User::factory()->create();
        /** @var Community $community */
        $community = Community::factory()->create();

        $community->members()->attach($user);

        $this->assertCount(1, $community->members);
    }
}
