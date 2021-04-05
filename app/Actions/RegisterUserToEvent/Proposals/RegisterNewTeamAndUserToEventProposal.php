<?php


namespace App\Actions\RegisterUserToEvent\Proposals;


use App\Models\RaceEvent;
use App\Models\User;

class RegisterNewTeamAndUserToEventProposal extends RegisterUserToEventProposal
{
    public bool   $createNewTeam = true;
    public string $teamName;

    public function __construct(RaceEvent $event, int $carModelId, string $teamName, User $user = null)
    {
        $this->teamName = $teamName;
        parent::__construct($event, $carModelId, $user);
    }
}
