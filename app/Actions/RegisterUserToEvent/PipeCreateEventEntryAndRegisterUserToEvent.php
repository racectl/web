<?php


namespace App\Actions\RegisterUserToEvent;


use App\Actions\RegisterUserToEvent\Proposals\RegisterNewTeamAndUserToEventProposal;
use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToEventProposal;
use App\Models\RaceEventEntry;

class PipeCreateEventEntryAndRegisterUserToEvent
{
    public function handle(RegisterUserToEventProposal $proposal, $next)
    {
        $raceEventEntry = new RaceEventEntry;

        if ($proposal instanceof RegisterNewTeamAndUserToEventProposal) {
            $raceEventEntry->teamName = $proposal->teamName;
            $raceEventEntry->generateTeamJoinCode();
        }

        $raceEventEntry->forcedCarModel = $proposal->carModelId;

        $proposal->event->entries()->save($raceEventEntry);

        $raceEventEntry->users()->attach($proposal->user);

        return $next($proposal);
    }
}
