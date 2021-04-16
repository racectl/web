<?php


namespace Models\Configs\ACC;


use App\Models\Configs\ACC\AccEventRules;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class AccEventRulesConfigModelTest extends TestCase
{
    /** @test */
    public function it_can_be_saved_with_database_defaults()
    {
        $rules = AccEventRules::create()->refresh();

        $this->assertCount(14, $rules->getAttributes());
    }

    /** @test */
    public function auto_rules_working()
    {
        $this->expectException(ValidationException::class);
        $rules = new AccEventRules;
        $rules->qualifyStandingType = 99;
    }

    /** @test */
    public function it_casts_booleans()
    {
        $rules = new AccEventRules;
        $rules->isRefuellingTimeFixed = 0;

        $this->assertSame(false, $rules->isRefuellingTimeFixed);
    }

    /** @test */
    public function it_generates_json_for_a_file()
    {
        $expected = file_get_contents(__DIR__ . '\eventRules.json');
        $actual = new AccEventRules;
        $actual->save();
        $actual->refresh();

        $this->assertEquals($expected, $actual->jsonForFile());
    }
}
