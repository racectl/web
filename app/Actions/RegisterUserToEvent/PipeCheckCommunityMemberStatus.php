<?php


namespace App\Actions\RegisterUserToEvent;


use App\Exceptions\UserNotCommunityMemberException;

class PipeCheckCommunityMemberStatus
{
    public function handle(RegisterUserToEventProposal $proposal, $next)
    {
        throw_unless($proposal->communityContainsUser(), UserNotCommunityMemberException::class);

        return $next($proposal);
    }
}
