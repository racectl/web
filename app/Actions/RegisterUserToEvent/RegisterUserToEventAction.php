<?php


namespace App\Actions\RegisterUserToEvent;


use App\Models\RaceEvent;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;

class RegisterUserToEventAction
{
    protected static array $pipes = [
        PipeCreateEventEntryAndRegisterUserToEvent::class
    ];

    public static function execute(RegisterUserToEventProposal $proposal)
    {
        return app(Pipeline::class)
            ->send($proposal)
            ->through(static::$pipes)
            ->thenReturn();
    }
}
