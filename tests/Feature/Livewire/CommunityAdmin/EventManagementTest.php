<?php

namespace Tests\Feature\Livewire\CommunityAdmin;

use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Http\Livewire\CommunityAdmin\EventManagement;
use App\Models\Community;
use Livewire\Livewire;
use Tests\TestCase;

class EventManagementTest extends TestCase
{
    /** @test */
    public function it_has_a_route()
    {
        $this->withoutExceptionHandling();
        /** @var Community $community */
        $community = Community::factory()->create()->refresh();
        $response  = $this->get($community->id . '/admin/event-management');
        $response
            ->assertOk()
            ->assertSee($community->name);
    }

    /** @test */
    public function it_creates_an_event_with_no_presets()
    {
        /** @var Community $community */
        $community = Community::factory()->create()->refresh();

        $spy = $this->spy(CreateAccEventAction::class);

        Livewire::test(EventManagement::class, ['community' => $community])
            ->assertSet('community', $community)
            ->set('input.newEventName', 'Test Event')
            ->set('input.availableCarsPreset', '')
            ->call('createNewEvent')
            ->assertHasNoErrors();

        $spy->shouldHaveReceived('execute')->with(Community::class, 'Test Event');
    }

    /** @test */
    public function a_event_name_is_required()
    {
        /** @var Community $community */
        $community = Community::factory()->create()->refresh();

        Livewire::test(EventManagement::class, ['community' => $community])
            ->set('input.availableCarsPreset', 'accGt3s')
            ->set('input.newEventName', '')
            ->call('createNewEvent')
            ->assertHasErrors(['newEventName' => 'required']);
    }

    /** @test */
    public function a_car_preset_must_be_valid()
    {
        /** @var Community $community */
        $community = Community::factory()->create()->refresh();

        Livewire::test(EventManagement::class, ['community' => $community])
            ->set('input.availableCarsPreset', 'nonsense')
            ->set('input.newEventName', 'Test')
            ->call('createNewEvent')
            ->assertHasErrors(['availableCarsPreset']);
    }
}
