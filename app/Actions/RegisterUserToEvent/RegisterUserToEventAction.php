<?php


namespace App\Actions\RegisterUserToEvent;


use App\Models\RaceEvent;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;

class RegisterUserToEventAction
{
    protected array $pipes = [
        PipeCheckCommunityMemberStatus::class,
        PipeCheckIfUserIsRegisteredAlready::class,
        PipeCreateEventEntryAndRegisterUserToEvent::class
    ];

    public function execute(RegisterUserToEventProposal $proposal)
    {
        return app(Pipeline::class)
            ->send($proposal)
            ->through($this->pipes)
            ->thenReturn();
    }
}
