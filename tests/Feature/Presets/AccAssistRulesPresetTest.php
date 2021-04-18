<?php

namespace Tests\Feature\Presets;

use App\Models\Preset;
use App\Presets\AccAssistRulesPreset;
use Tests\TestCase;

class AccAssistRulesPresetTest extends TestCase
{
    /** @test */
    public function it_hydrates_from_db()
    {
        $db = Preset::firstWhere('type', AccAssistRulesPreset::class);
        $preset = new AccAssistRulesPreset($db);
        $checks = ['stabilityControlLevelMax', 'disableAutosteer', 'disableAutoLights', 'disableAutoWiper', 'disableAutoEngineStart', 'disableAutoPitLimiter', 'disableAutoGear', 'disableAutoClutch', 'disableIdealLine'];
        foreach ($checks as $check) {
            $this->assertEquals($db->data->$check, $preset->$check);
        }
    }
}
