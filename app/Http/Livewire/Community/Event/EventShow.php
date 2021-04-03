<?php

namespace App\Http\Livewire\Community\Event;

use App\Models\Community;
use App\Models\RaceEvent;
use Livewire\Component;

class EventShow extends Component
{
    public Community $community;
    public RaceEvent $event;

    public function render()
    {
        return view('livewire.community.event.event-show')
            ->layout('components.layout', ['title' => $this->community->name . ' - ' . $this->event->name]);
    }
}
