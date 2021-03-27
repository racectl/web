<?php

namespace Tests\Feature\Livewire\RCAdmin;

use Livewire\Livewire;
use Tests\TestCase;

class CommunityManagementTest extends TestCase
{
    /** @test */
    public function it_has_a_route()
    {
        $response = $this->get('/rcadmin/community');
        $response
            ->assertOk()
            ->assertSee('Community Management')
            ->assertSee('New World Sim Racing');
    }

    /** @test */
    public function it_creates_a_new_community()
    {
        Livewire::test(\App\Http\Livewire\RCAdmin\CommunityManagement::class)
            ->set('input.newCommunityName', 'New Community')
            ->call('createNewCommunity')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('communities', [
            'name' => 'New Community'
        ]);
    }

    /** @test */
    public function community_name_is_required_to_create()
    {
        Livewire::test(\App\Http\Livewire\RCAdmin\CommunityManagement::class)
            ->set('input.newCommunityName', '')
            ->call('createNewCommunity')
            ->assertHasErrors(['newCommunityName' => 'required']);
    }
}
