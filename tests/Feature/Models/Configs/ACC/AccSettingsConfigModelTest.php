<?php


namespace Models\Configs\ACC;

use App\Models\Configs\ACC\AccSettings;
use Tests\TestCase;

class AccSettingsConfigModelTest extends TestCase
{
    /** @test */
    public function auto_validation_throws_exception_when_invalid()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
        $settings           = new AccSettings;
        $settings->carGroup = 'Not Valid';
    }

    /** @test */
    public function auto_validation_allows_attribute_to_be_set_when_valid()
    {
        $settings           = new AccSettings;
        $settings->carGroup = 'GT3';

        $this->assertEquals('GT3', $settings->getAttribute('car_group'));
    }

    /** @test */
    public function it_can_be_created_by_factory()
    {
        $settings = AccSettings::factory()->create();
        $fromDb   = AccSettings::first();

        $this->assertEquals($settings->getAttributes(), $fromDb->getAttributes());
    }

    /** @test */
    public function all_parameters_are_defaulted_in_database_except_server_name()
    {
        $settings             = new AccSettings;
        $settings->serverName = "Testing Name";
        $settings->save();
        $settings->refresh();
        $this->assertEquals('FreeForAll', $settings->carGroup);
        $this->assertCount(19, $settings->getAttributes());
    }

    /** @test */
    public function auto_parameter_renaming_between_snake_and_camel_cases()
    {
        $settings              = new AccSettings;
        $settings->server_name = "Not Expected";
        $settings->serverName  = "Expected";
        $this->assertEquals('Expected', $settings->getAttribute('server_name'));
    }

    /** @test */
    public function it_gets_formation_lap_descriptions()
    {
        $settings = new AccSettings;
        $settings->formationLapType = 0;
        $this->assertEquals(
            'Old limiter lap.',
            $settings->formationLapTypeDescription
        );

        $settings->formationLapType = 1;
        $this->assertEquals(
            'Free (replaces manual start), only usable for private servers',
            $settings->formationLapTypeDescription
        );

        $settings->formationLapType = 3;
        $this->assertEquals(
            'Default formation lap with position control and UI.',
            $settings->formationLapTypeDescription
        );
    }

    /**
     * @test
     *
     * Testing that any null values are excluded from the json output for the server
     *      config file.
     */
    public function it_generates_json_needed_for_file()
    {
        /** @var AccSettings $settings */
        AccSettings::factory()->defaults()->create(['server_name' => 'Server Name']);
        $settings = AccSettings::first();

        $expected = file_get_contents(__DIR__ . '\expectedSettings.json');
        $this->assertEquals($expected, $settings->jsonForFile());
    }
}
