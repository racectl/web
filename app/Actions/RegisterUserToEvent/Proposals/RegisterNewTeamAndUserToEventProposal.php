<?php


namespace App\Actions\RegisterUserToEvent\Proposals;


class RegisterNewTeamAndUserToEventProposal extends RegisterUserToEventProposal
{
    public bool   $createNewTeam = true;
    public string $teamName;
}
