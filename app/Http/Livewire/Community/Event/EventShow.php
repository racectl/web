<?php

namespace App\Http\Livewire\Community\Event;

use App\Actions\RegisterUserToEvent\Proposals\RegisterNewTeamAndUserToEventProposal;
use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToExistingTeamProposal;
use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToEventProposal;
use App\Http\Livewire\RuleBasedInputs;
use App\Models\Community;
use App\Models\RaceEvent;
use Livewire\Component;

class EventShow extends Component
{
    use RuleBasedInputs;

    public Community $community;
    public RaceEvent $event;

    public $rules = [
        'selectedCar'      => 'required|exists:cars,id',
        'teamJoinCode'     => 'required|string|max:255',
        'joinExistingTeam' => 'required|boolean',
        'teamName'         => 'required|string'
    ];

    public function inputDefaults()
    {
        $this->setInputDefault('selectedCar', $this->event->availableCars->first()->id);
        $this->setInputDefault('joinExistingTeam', 0);
    }

    public function registerUser(RegisterUserToEventAction $registerAction)
    {
        $this->validateOnly('selectedCar');

        $proposal = new RegisterUserToEventProposal(
            $this->event,
            $this->input('selectedCar'),
        );

        $registerAction->execute($proposal);
        $this->event->load('entries');
    }

    public function registerNewTeam(RegisterUserToEventAction $registerAction)
    {
        $this->validateOnly('teamName');
        $this->validateOnly('selectedCar');

        $proposal                = new RegisterNewTeamAndUserToEventProposal(
            $this->event,
            $this->input('selectedCar')
        );
        $proposal->teamName      = $this->input('teamName');
        $registerAction->execute($proposal);
    }

    public function joinTeam(RegisterUserToEventAction $registerAction)
    {
        $this->validateOnly('teamJoinCode');
        $proposal               = new RegisterUserToExistingTeamProposal(
            $this->event,
            $this->input('selectedCar')
        );
        $proposal->joinTeamCode = $this->input('teamJoinCode');
        $registerAction->execute($proposal);
    }

    public function render()
    {
        return view('livewire.community.event.event-show')
            ->layout('components.layout', ['title' => $this->community->name . ' - ' . $this->event->name]);
    }
}
