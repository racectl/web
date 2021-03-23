<?php

namespace Tests\Feature\Models;

use App\Models\Community;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    /** @test */
    public function it_has_a_many_to_many_with_communities()
    {
        $user = User::first();
        $community = Community::first();
        $community->members()->attach($user);

        $this->assertTrue($user->communities->contains($community));
    }
}
