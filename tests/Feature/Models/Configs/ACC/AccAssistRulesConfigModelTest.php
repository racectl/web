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
        $rules = AccAssistRules::factory()->defaults()->create();
        $expected = file_get_contents(__DIR__ . '/ExpectedAssistRules.json');

        $this->assertEquals($expected, $rules->jsonForFile());
    }
}
