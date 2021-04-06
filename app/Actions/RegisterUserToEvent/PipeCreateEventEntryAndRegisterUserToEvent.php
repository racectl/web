<?php


namespace App\Actions\RegisterUserToEvent;


use App\Actions\RegisterUserToEvent\Proposals\RegisterNewTeamAndUserToEventProposal;
use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToEventProposal;
use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToExistingTeamProposal;
use App\Models\RaceEventEntry;

class PipeCreateEventEntryAndRegisterUserToEvent
{
    public function handle(RegisterUserToEventProposal $proposal, $next)
    {

        if ($proposal instanceof RegisterUserToExistingTeamProposal) {
            $raceEventEntry = RaceEventEntry::whereTeamJoinCode($proposal->joinTeamCode)->first();
        } else {
            $raceEventEntry = new RaceEventEntry;
            $raceEventEntry->forcedCarModel = $proposal->carModelId;
        }

        if ($proposal instanceof RegisterNewTeamAndUserToEventProposal) {
            $raceEventEntry->teamName = $proposal->teamName;
            $raceEventEntry->generateTeamJoinCode();
        }

        $proposal->event->entries()->save($raceEventEntry);

        $raceEventEntry->users()->attach($proposal->user);

        return $next($proposal);
    }
}
