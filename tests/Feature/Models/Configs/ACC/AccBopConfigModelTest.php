<?php

namespace Tests\Feature\Models\Configs\ACC;

use App\Models\AccConfig;
use App\Models\Configs\ACC\AccBop;
use Tests\TestCase;

class AccBopConfigModelTest extends TestCase
{
    public $model = AccBop::class;

    /** @test */
    public function it_belongs_to_acc_config()
    {
        $bop = AccBop::factory()->create();
        $this->assertInstanceOf(AccConfig::class, $bop->config);
    }

    /** @test */
    public function it_auto_validates_car_model()
    {
        $this->expectValidationException('carModel', 'wrong');
    }

    /** @test */
    public function it_auto_validates_ballast_kg()
    {
        $this->expectValidationException('ballastKg', 500);
    }

    /** @test */
    public function it_auto_validates_restrictor()
    {
        $this->expectValidationException('restrictor', 50);
    }

    /** @test */
    public function it_has_a_computed_track_attibute()
    {
        /** @var AccBop $bop */
        $bop      = AccBop::factory()->create();
        $expected = $bop->config->raceEvent->track;
        $this->assertEquals($expected, $bop->track);
    }
}
