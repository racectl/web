<?php

namespace Tests\Feature\Livewire\CommunityAdmin\EventManagement;

use App\Http\Livewire\CommunityAdmin\EventManagement\AccEventSessions;
use App\Http\Livewire\CommunityAdmin\EventManagement\IndividualAccEventSession;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class IndividualAccEventSessionTest extends TestCase
{
    /** @test */
    public function it_has_rules()
    {
        $livewireComponent = new IndividualAccEventSession;
        $this->assertEquals(AccEventSession::rules(), $livewireComponent->getPropertyValue('rules'));
    }

    /** @test */
    public function it_sets_input_defaults_to_model_properties()
    {
        $session = AccEventSession::factory()->create();
        $testableLivewire = Livewire::test(IndividualAccEventSession::class, ['session' => $session]);
        $input = $testableLivewire->payload['serverMemo']['data']['input'];

        foreach (AccEventSession::rules() as $param => $null) {
            $this->assertEquals($input[$param], $session->$param);
        }
    }
}
