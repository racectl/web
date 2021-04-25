<?php

namespace App\Http\Livewire\Community\Event;

use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToEventProposal;
use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Http\Livewire\BetterComponent;
use App\Http\Livewire\RuleBasedInputs;
use App\Models\RaceEvent;

class DriverEntrantOptions extends BetterComponent
{
    use RuleBasedInputs;

    public RaceEvent $event;

    public $rules = [
        'selectedCar' => 'required|exists:cars,id'
    ];

    public function inputDefaults()
    {
        $this->setInputDefault('selectedCar', $this->event->availableCars->first()->id);
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

        $this->emit('refreshDriversList');
    }

    public function withdrawUser()
    {
        $this->inform('Unregister Not Programmed');
    }

    public function changeCar()
    {
        $this->inform('Update Car Not Programmed');
    }

    public function render()
    {
        return view('livewire.community.event.driver-entrant-options');
    }
}
