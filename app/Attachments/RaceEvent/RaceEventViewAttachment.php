<?php


namespace App\Attachments\RaceEvent;


use App\Attachments\UsesModel;
use App\Models\RaceEvent;

class RaceEventViewAttachment
{
    use UsesModel;

    protected RaceEvent $raceEvent;

    public function __construct(RaceEvent $raceEvent)
    {
        $this->raceEvent = $raceEvent;
        $this->modelAccessor = 'raceEvent';
    }

    public function showLink(): string
    {
        return route('community.event.show', [
            'community' => $this->raceEvent->community,
            'event'     => $this->raceEvent
        ]);
    }
}
