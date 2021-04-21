<?php

namespace App\Http\Livewire\CommunityAdmin\EventManagement;

use App\CustomCollections\AccEventSessionsCollection;
use App\Models\Community;
use App\Models\Configs\ACC\AccEventSession;
use App\Models\RaceEvent;
use Livewire\Component;

class AccEventSessions extends Component
{
    public Community $community;
    public RaceEvent $event;
    public AccEventSessionsCollection $sessions;

    protected $listeners = ['refreshSessions' => '$refresh'];

    public function mount()
    {
        $this->sessions = $this->event->accConfig->event->accEventSessions;
    }

    public function addQuali()
    {
        $session = AccEventSession::make([
            'session_type' => 'Q',
            'hour_of_day' => 11,
            'day_of_weekend' => 2,
            'session_duration_minutes' => 20
        ]);
        $eventConfig = $this->event->accConfig->event;
        $eventConfig->accEventSessions()->save($session);
        $this->event->refresh();
        $this->mount();
    }

    public function addRace()
    {
        $session = AccEventSession::make([
            'session_type' => 'R',
            'hour_of_day' => 11,
            'day_of_weekend' => 3,
            'session_duration_minutes' => 30
        ]);
        $eventConfig = $this->event->accConfig->event;
        $eventConfig->accEventSessions()->save($session);
        $this->event->refresh();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.community-admin.event-management.acc-event-sessions')
            ->layout('components.layout', ['title' => $this->community->name . ' - Events']);
    }
}
