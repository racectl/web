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

    public function execute(Community $community, string $eventName, string $track, int $teamEvent = 0): RaceEvent
    {
        $event = new RaceEvent;
        $event->name = $eventName;
        $event->sim = 'ACC';
        $event->track = $track;
        $event->teamEvent = $teamEvent;

        $community->events()->save($event);

        return app(Pipeline::class)
            ->send($event)
            ->through($this->pipes)
            ->thenReturn();
    }
}
