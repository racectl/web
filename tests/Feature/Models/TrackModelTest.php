<?php


namespace Tests\Feature\Models;


use App\Models\Track;
use Database\Seeders\TrackSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

class TrackModelTest extends \Tests\TestCase
{
    /** @test */
    public function it_seeds()
    {
        //fix to reset ids when running full test suit.
        Track::truncate();

        $this->seed(TrackSeeder::class);

        $this->assertDatabaseCount('tracks', 41);

        $expected = [
            'id'               => 1,
            'game_config_id'   => 'monza',
            'name'             => 'Monza 2018',
            'sim'              => 'acc',
            'pit_boxes'        => 29,
            'max_server_slots' => 60
        ];

        $actual = Track::first();

        $this->assertEquals($expected, $actual->getAttributes());
    }

    /** @test */
    public function it_auto_validates()
    {
        $this->expectException(ValidationException::class);
        $track = new Track;
        $track->gameConfigId = null;
    }
}
