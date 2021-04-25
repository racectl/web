<?php

namespace App\Http\Livewire\Community\Event;

use App\Actions\RegisterUserToEvent\Proposals\RegisterNewTeamAndUserToEventProposal;
use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToExistingTeamProposal;
use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Http\Livewire\BetterComponent;
use App\Http\Livewire\RuleBasedInputs;
use App\Models\RaceEvent;
use App\Models\RaceEventEntry;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeamEntrantOptions extends BetterComponent
{
    use RuleBasedInputs;

    public RaceEvent       $event;
    public ?RaceEventEntry $authEntry;

    public $rules = [
        'selectedCar'      => 'required|exists:cars,id',
        'teamJoinCode'     => 'required|string|max:255',
        'joinExistingTeam' => 'required|boolean',
        'teamName'         => 'required|string',
        'teamFirstDriver'  => 'exists:users,id'
    ];

    public function mount()
    {
        $this->reloadEntryState();
    }

    protected function reloadEntryState()
    {
        $this->event->load('entries');
        $this->authEntry = $this->event->entryForUser(Auth::user());
        $this->emit('refreshDriversList');
    }

    public function inputDefaults()
    {
        $this->setInputDefault('selectedCar', $this->event->availableCars->first()->id);
        $this->setInputDefault('joinExistingTeam', 0);
    }

    public function updatedInputTeamFirstDriver($value)
    {
        $this->validateOnly('teamFirstDriver');

        $driver = User::find($value);

        $this->inform('Not Programmed', $driver->displayName . ' will be set as first driver');
    }

    public function registerNewTeam(RegisterUserToEventAction $registerAction)
    {
        $this->validateOnly('teamName');
        $this->validateOnly('selectedCar');

        $proposal = new RegisterNewTeamAndUserToEventProposal(
            $this->event,
            $this->input('selectedCar'),
            $this->input('teamName')
        );

        $registerAction->execute($proposal);

        $this->reloadEntryState();
    }

    public function joinTeam(RegisterUserToEventAction $registerAction)
    {
        $this->validateOnly('teamJoinCode');

        $proposal = new RegisterUserToExistingTeamProposal(
            $this->event,
            $this->input('teamJoinCode')
        );

        $registerAction->execute($proposal);

        $this->reloadEntryState();
    }

    public function withdrawTeam()
    {
        $this->authEntry->delete();
        $this->success('Team Withdrawn From Event');
        $this->reloadEntryState();
    }

    public function leaveTeam()
    {
        $this->authEntry->users()->detach(Auth::user());
        $this->success('Withdrawn From Team');
        $this->reloadEntryState();
    }

    public function render()
    {
        return view('livewire.community.event.team-entrant-options');
    }
}
