<?php

namespace Tests\Feature\Presets;

use App\Models\Car;
use App\Models\Preset;
use App\Presets\AccCarsPreset;
use Tests\TestCase;

class AccCarsPresetTest extends TestCase
{
    /** @test */
    public function it_hydrates_from_the_preset_model()
    {
        $db = Preset::first();
        $preset = new AccCarsPreset($db);
        $this->assertEquals($db->data, $preset->carIds);
        $this->assertIsArray($preset->carIds);
    }
}
