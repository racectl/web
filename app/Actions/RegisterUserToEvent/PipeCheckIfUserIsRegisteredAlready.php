<?php


namespace App\Actions\RegisterUserToEvent;


use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToEventProposal;
use App\Exceptions\UserAlreadyRegisteredToEventException;

class PipeCheckIfUserIsRegisteredAlready
{
    public function handle(RegisterUserToEventProposal $proposal, $next)
    {
        $entries = $proposal->event->entries->load('users');

        foreach ($entries as $entry) {
            throw_if(
                $entry->users->contains($proposal->user),
                UserAlreadyRegisteredToEventException::class
            );
        }

        return $next($proposal);
    }
}
