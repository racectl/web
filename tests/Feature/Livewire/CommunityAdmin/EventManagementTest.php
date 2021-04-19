<?php

namespace Tests\Feature\Livewire\CommunityAdmin;

use App\Actions\CreateAccEvent\AccEventSelectedPresets;
use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Http\Livewire\CommunityAdmin\EventManagement;
use App\Models\Community;
use App\Models\Presets\AccWeatherPreset;
use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Track;
use Livewire\Livewire;
use Tests\TestCase;

class EventManagementTest extends TestCase
{
    protected $eventSpy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->eventSpy = $this->spy(CreateAccEventAction::class);
    }

    /** @test */
    public function it_has_a_route()
    {
        $this->withoutExceptionHandling();
        /** @var Community $community */
        $community = Community::factory()->create()->refresh();
        $response  = $this->get($community->adminEventManagementLink());
        $response
            ->assertOk()
            ->assertSee($community->name);
    }

    /** @test */
    public function it_creates_an_event_with_no_presets()
    {
        /** @var Community $community */
        $community = Community::factory()->create()->refresh();

        $track = Track::acc()->get()->random()->gameConfigId;

        Livewire::test(EventManagement::class, ['community' => $community])
            ->assertSet('community', $community)
            ->set('input.track', $track)
            ->set('input.newEventName', 'Test Event')
            ->set('input.availableCarsPreset', '')
            ->call('createNewEvent')
            ->assertHasNoErrors();

        $this->eventSpy->shouldHaveReceived('execute')->with(Community::class, 'Test Event', $track);
    }

    /** @test */
    public function a_event_name_is_required()
    {
        $this->withoutExceptionHandling();
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

    /** @test */
    public function it_creates_an_event_with_a_car_preset()
    {
        /** @var Community $community */
        $community = Community::factory()->create()->refresh();

        Livewire::test(EventManagement::class, ['community' => $community])
            ->set('input.newEventName', 'Test Event')
            ->set('input.availableCarsPreset', 'accGt3s')
            ->set('input.track', 'barcelona')
            ->call('createNewEvent')
            ->assertHasNoErrors();

        $presets = app(AccEventSelectedPresets::class);
        $this->assertEquals('accGt3s', $presets->availableCars);
    }

    /** @test */
    public function it_creates_an_event_with_a_weather_preset()
    {
        /** @var Community $community */
        $community = Community::factory()->create()->refresh();

        Livewire::test(EventManagement::class, ['community' => $community])
            ->set('input.newEventName', 'Test Event')
            ->set('input.weatherPreset', 1)
            ->set('input.track', 'barcelona')
            ->call('createNewEvent')
            ->assertHasNoErrors();

        $presets = app(AccEventSelectedPresets::class);
        $this->assertInstanceOf(AccWeatherPreset::class, $presets->weather);
    }

    /** @test */
    public function a_weather_preset_must_be_valid()
    {
        /** @var Community $community */
        $community = Community::factory()->create()->refresh();

        Livewire::test(EventManagement::class, ['community' => $community])
            ->set('input.weatherPreset', 0)
            ->set('input.newEventName', 'Test')
            ->call('createNewEvent')
            ->assertHasErrors(['weatherPreset']);
    }

    /** @test */
    public function it_creates_an_event_with_an_assist_rules_preset()
    {
        /** @var Community $community */
        $community = Community::factory()->create();

        Livewire::test(EventManagement::class, ['community' => $community])
            ->set('input.newEventName', 'Test Event')
            ->set('input.assistRulesPreset', 1)
            ->set('input.track', 'barcelona')
            ->call('createNewEvent')
            ->assertHasNoErrors();

        $presets = app(AccEventSelectedPresets::class);
        $this->assertInstanceOf(AccAssistRules::class, $presets->assistRules);
    }
}
