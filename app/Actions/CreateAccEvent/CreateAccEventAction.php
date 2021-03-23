<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Community;
use App\Models\RaceEvent;
use Illuminate\Pipeline\Pipeline;

class CreateAccEventAction
{
    protected static array $pipes = [
        PipeCreateAccConfig::class,
        PipeCreateAccAssistRules::class,
        PipeCreateAccEventConfigWithPracticeSession::class,
        PipeCreateAccEventRules::class,
        PipeCreateAccSettings::class,
    ];

    public static function execute(Community $community, string $eventName): RaceEvent
    {
        $event = new RaceEvent;
        $event->name = $eventName;
        $event->track = 'barcelona';

        $community->events()->save($event);

        return app(Pipeline::class)
            ->send($event)
            ->through(static::$pipes)
            ->thenReturn();
    }
}
