<?php


namespace Models\Configs\ACC;


use App\Models\AccConfig;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventSession;
use App\Models\Track;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class AccEventConfigModelTest extends TestCase
{
    /** @test */
    public function it_belongs_to_an_acc_config()
    {
        /** @var AccEvent $event */
        $event = AccEvent::factory()->create()->refresh();

        $this->assertInstanceOf(AccConfig::class, $event->accConfig);
    }

    /** @test */
    public function it_has_event_session_relation()
    {
        /** @var AccEvent $event */
        $event = AccEvent::factory()
            ->has(
                AccEventSession::factory()->count(3)
            )->create();

        $this->assertInstanceOf(Collection::class, $event->accEventSessions);
        $this->assertCount(3, $event->accEventSessions);
        $this->assertInstanceOf(AccEventSession::class, $event->accEventSessions->first());
    }

    /** @test */
    public function it_generates_json_for_a_file()
    {
        /** @var AccEvent $event */
        $event = AccEvent::factory([
            'meta_data' => "String of Meta Data."
        ])->create()->refresh();

        $event->accConfig->raceEvent->track = 'monza';

        $sessions = collect();

        $sessions->push(AccEventSession::make([
            'hour_of_day'              => 10,
            'day_of_weekend'           => 1,
            'time_multiplier'          => 1,
            'session_type'             => 'P',
            'session_duration_minutes' => 20
        ]));

        $sessions->push(AccEventSession::make([
            'hour_of_day'              => 17,
            'day_of_weekend'           => 2,
            'time_multiplier'          => 8,
            'session_type'             => 'Q',
            'session_duration_minutes' => 10
        ]));

        $sessions->push(AccEventSession::make([
            'hour_of_day'              => 16,
            'day_of_weekend'           => 3,
            'time_multiplier'          => 3,
            'session_type'             => 'Q',
            'session_duration_minutes' => 20
        ]));

        $event->accEventSessions()->saveMany($sessions);

        $expected = file_get_contents(__DIR__ . '\event.json');
        $this->assertEquals($expected, $event->jsonForFile());
    }
}
