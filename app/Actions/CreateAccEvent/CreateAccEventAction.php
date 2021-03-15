<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Community;
use App\Models\RaceEvent;
use Illuminate\Pipeline\Pipeline;

class CreateAccEventAction
{
    protected static array $pipes = [
        CreateAccConfigPipe::class,
        CreateAccAssistRulesPipe::class,
        CreateAccEventConfigWithPracticeSessionPipe::class,
        CreateAccEventRulesPipe::class,
        CreateAccSettingsPipe::class,
    ];

    public static function execute(Community $community, string $eventName)
    {
        $event = new RaceEvent;
        $event->name = $eventName;
        $event->track = 'barcelona';

        $community->events()->save($event);

        app(Pipeline::class)
            ->send($event)
            ->through(static::$pipes)
            ->thenReturn();
    }
}
