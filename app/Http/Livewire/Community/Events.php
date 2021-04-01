<?php

namespace App\Http\Livewire\Community;

use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Actions\RegisterUserToEvent\RegisterUserToEventProposal;
use App\Http\Livewire\BetterComponent;
use App\Models\Community;
use App\Models\RaceEvent;

class Events extends BetterComponent
{
    /** @var Community */
    public $community;

    public function mount(Community $community)
    {
        $this->community = $community;
    }

    public function quickRegisterToEvent(
        RegisterUserToEventAction $action,
        RaceEvent $event
    ) {
        $proposal = new RegisterUserToEventProposal($event, 0);
        $action->execute($proposal);
        $this->community->load('events');
    }

    public function render()
    {
        return view('livewire.community.events')
            ->layout('components.layout', ['title' => $this->community->name . ' - Events']);
    }
}
