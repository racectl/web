<?php


namespace Models\Configs\ACC;


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
    public function it_can_be_created_by_a_factory()
    {
        $factory = AccAssistRules::factory()->create();
        $db  = AccAssistRules::first();

        $this->assertEquals($factory->getAttributes(), $db->getAttributes());
    }

    /** @test */
    public function it_generates_json_needed_for_file()
    {
        AccAssistRules::factory()->defaults()->create();
        $rules = AccAssistRules::first();
        $expected = file_get_contents(__DIR__ . '/ExpectedAssistRules.json');

        $this->assertEquals($expected, $rules->jsonForFile());
    }
}
