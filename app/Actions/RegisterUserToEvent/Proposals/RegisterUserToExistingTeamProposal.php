<?php


namespace App\Actions\RegisterUserToEvent\Proposals;


use App\Models\RaceEvent;
use App\Models\User;

class RegisterUserToExistingTeamProposal extends RegisterUserToEventProposal
{
    public string $joinTeamCode;

    public function __construct(RaceEvent $event, string $joinTeamCode, User $user = null)
    {
        $this->joinTeamCode = $joinTeamCode;
        parent::__construct($event, -1, $user);
    }
}
