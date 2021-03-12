<?php

namespace Tests\Feature\CustomCollections;

use App\Exceptions\InvalidEventSessionsException;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventSession;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\TestCase;

class AccEventSessionsCollectionTest extends TestCase
{
    /** @test */
    public function it_throws_exception_when_race_sessions_only_contain_race_session()
    {
        /** @var AccEvent $event */
        $event = AccEvent::factory()->has(
            AccEventSession::factory([
                'session_type' => 'R'
            ])
        )->create()->load('accEventSessions');

        $this->expectException(InvalidEventSessionsException::class);
        $event->accEventSessions->allForFinalBuild();
    }

    /** @test */
    public function it_doesnt_throw_exception_when_valid()
    {
        /** @var AccEvent $event */
        $event = AccEvent::factory()->has(
            AccEventSession::factory()
                ->count(2)
                ->state(new Sequence(
                    ['session_type' => 'P'],
                    ['session_type' => 'R']
                ))
        )->create()->load('accEventSessions');

        $valid = $event->accEventSessions->allForFinalBuild();
        $this->assertCount(2, $valid);
    }
}
