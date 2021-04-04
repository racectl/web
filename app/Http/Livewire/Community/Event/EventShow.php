<?php

namespace App\Http\Livewire\Community\Event;

use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Actions\RegisterUserToEvent\RegisterUserToEventProposal;
use App\Http\Livewire\RuleBasedInputs;
use App\Models\Community;
use App\Models\RaceEvent;
use App\Models\RaceEventEntry;
use Livewire\Component;

class EventShow extends Component
{
    use RuleBasedInputs;

    public Community $community;
    public RaceEvent $event;

    public $rules = [
        'selectedCar' => 'exists:car,id',
        'teamJoinCode' => 'string|max:255'
    ];

    public function __construct($id = null)
    {
        $this->rules['teamName'] = RaceEventEntry::rules()['teamName'];
        parent::__construct($id);
    }

    public function inputDefaults()
    {
        $this->setInputDefault('selectedCar', $this->event->availableCars->first()->id);
    }

    public function registerUser(RegisterUserToEventAction $registerAction)
    {
        $proposal = new RegisterUserToEventProposal(
            $this->event,
            $this->input('selectedCar'),
        );
        $registerAction->execute($proposal);
    }

    public function render()
    {
        return view('livewire.community.event.event-show')
            ->layout('components.layout', ['title' => $this->community->name . ' - ' . $this->event->name]);
    }
}
