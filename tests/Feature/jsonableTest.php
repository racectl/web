<?php

namespace Tests\Feature;

use App\Contracts\Jsonable;
use App\Models\Configs\ACC\AccSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class jsonableTest extends TestCase
{
    /** @test */
    public function it_works()
    {
        /** @var AccSettings $settings */
        AccSettings::factory()->defaults()->create(['server_name' => 'Server Name']);
        $settings = AccSettings::first();

        $expected = file_get_contents(__DIR__ . '\Models\Configs\ACC\expectedSettings.json');
        $this->assertEquals($expected, $settings->jsonForFile());
    }
}

class fakeJsonable implements Jsonable
{
    public $attributes = [];
}
