<?php

namespace Tests\Feature\Models\Presets;

use App\Models\Presets\AccPitConditionsPreset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccPitConditionsPresetTest extends TestCase
{
    /** @test */
    public function it_has_defaults()
    {
        $first = AccPitConditionsPreset::find(1);
        $second = AccPitConditionsPreset::find(2);

        $this->assertNotNull($first);
        $this->assertNotNull($second);
    }
}
