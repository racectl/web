<?php

namespace App\Http\Livewire\Community\Event;

use App\Http\Livewire\BetterComponent;
use App\Models\Community;
use App\Models\RaceEvent;

class EventShow extends BetterComponent
{
    public Community $community;
    public RaceEvent $event;

    protected $listeners = ['refreshDriversList' => '$refresh'];

    public function render()
    {
        return view('livewire.community.event.event-show')
            ->layout('components.layout', ['title' => $this->community->name . ' - ' . $this->event->name]);
    }
}
