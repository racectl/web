<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Community;
use App\Models\RaceEvent;
use Illuminate\Pipeline\Pipeline;

class CreateAccEventAction
{
    protected array $pipes = [
        PipeCreateAccConfig::class,
        PipeCreateAccAssistRules::class,
        PipeCreateAccEventConfigWithPracticeSession::class,
        PipeCreateAccEventRules::class,
        PipeCreateAccSettings::class,
        PipeAssignAvailableCars::class
    ];

    public function execute(Community $community, string $eventName): RaceEvent
    {
        $event = new RaceEvent;
        $event->name = $eventName;
        $event->sim = 'ACC';
        $event->track = 'barcelona';

        $community->events()->save($event);

        return app(Pipeline::class)
            ->send($event)
            ->through($this->pipes)
            ->thenReturn();
    }
}
