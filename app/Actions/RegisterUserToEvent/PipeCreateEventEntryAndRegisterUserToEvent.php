<?php


namespace App\Actions\RegisterUserToEvent;


use App\Models\RaceEventEntry;

class PipeCreateEventEntryAndRegisterUserToEvent
{
    public function handle(RegisterUserToEventProposal $proposal, $next)
    {
        $raceEventEntry = new RaceEventEntry;
        $raceEventEntry->forcedCarModel = $proposal->carModelId;

        $proposal->event->entries()->save($raceEventEntry);

        $raceEventEntry->users()->attach($proposal->user);

        return $next($proposal);
    }
}
