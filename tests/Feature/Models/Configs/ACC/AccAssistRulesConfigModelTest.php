<?php


namespace Models\Configs\ACC;


use App\Models\Community;
use App\Models\Configs\ACC\AccAssistRules;
use Tests\TestCase;

class AccAssistRulesConfigModelTest extends TestCase
{
    /** @test */
    public function it_auto_validates()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
        $rules = new AccAssistRules;
        $rules->stabilityControlLevelMax = 101;
    }

    /** @test */
    public function it_generates_json_needed_for_file()
    {
        AccAssistRules::factory()->defaults()->create();
        $rules = AccAssistRules::firstWhere('preset_for_community', null);
        $expected = file_get_contents(__DIR__ . '/ExpectedAssistRules.json');

        $this->assertEquals($expected, $rules->jsonForFile());
    }

    protected $defaultFromSeederCount = 3;

    /** @test */
    public function it_returns_default_presets()
    {
        $presets = AccAssistRules::presets();
        $this->assertCount($this->defaultFromSeederCount, $presets);
    }

    /** @test */
    public function it_returns_community_specific_defaults()
    {
        /** @var Community $community */
        $community = Community::factory()->create()->refresh();
        AccAssistRules::create([
            'preset_name' => 'All Enabled',
            'preset_for_community' => $community->id,
            'stability_control_level_max' => 100,
            'disable_autosteer' => 1,
            'disable_auto_lights' => 0,
            'disable_auto_wiper' => 0,
            'disable_auto_engine_start' => 0,
            'disable_auto_pit_limiter' => 0,
            'disable_auto_gear' => 0,
            'disable_auto_clutch' => 0,
            'disable_ideal_line' => 0,
        ]);

        $presets = AccAssistRules::presets($community->id);
        $this->assertCount($this->defaultFromSeederCount + 1, $presets);
    }
}
