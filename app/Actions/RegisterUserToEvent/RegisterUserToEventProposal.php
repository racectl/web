<?php


namespace App\Actions\RegisterUserToEvent;


use App\Models\Community;
use App\Models\RaceEvent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterUserToEventProposal
{
    public User      $user;
    public Community $community;
    public RaceEvent $event;
    public int       $carModelId;

    public function __construct(RaceEvent $event, int $carModelId, User $user = null)
    {
        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->user       = $user ?? Auth::user();
        $this->event      = $event;
        $this->carModelId = $carModelId;

        $this->community = $event->community;
    }

    public function communityContainsUser(): bool
    {
        return $this->community->members->contains($this->user);
    }
}
