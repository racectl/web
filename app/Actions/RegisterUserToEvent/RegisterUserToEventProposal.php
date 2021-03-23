<?php


namespace App\Actions\RegisterUserToEvent;


use App\Models\RaceEvent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterUserToEventProposal
{
    public User      $user;
    public RaceEvent $event;
    public int       $carModelId;

    public function __construct(RaceEvent $event, int $carModelId, User $user = null)
    {
        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->user       = $user ?? Auth::user();
        $this->event      = $event;
        $this->carModelId = $carModelId;
    }
}
