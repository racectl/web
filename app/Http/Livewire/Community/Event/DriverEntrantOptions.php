<?php

namespace App\Http\Livewire\Community\Event;

use App\Actions\RegisterUserToEvent\Proposals\RegisterUserToEventProposal;
use App\Actions\RegisterUserToEvent\RegisterUserToEventAction;
use App\Exceptions\SelectedVehicleNotInAvailableCarsException;
use App\Http\Livewire\BetterComponent;
use App\Http\Livewire\RuleBasedInputs;
use App\Models\RaceEvent;
use Auth;

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
        $entry = $this->event->entryForUser(Auth::user());
        $entry->delete();

        $this->event->refresh();
        $this->emit('refreshDriversList');
        $this->success('Withdrawn From Event');
    }

    public function changeCar()
    {
        $this->validate();
        throw_if(
            ! $this->event->availableCars->contains($this->input('selectedCar')),
            SelectedVehicleNotInAvailableCarsException::class
        );

        $entry = $this->event->entryForUser(Auth::user());
        $entry->forcedCarModel = $this->input('selectedCar');
        $entry->save();

        $car = $this->event->availableCars->firstWhere('id', $this->input('selectedCar'));

        $this->emit('refreshDriversList');
        $this->success('Car Updated', 'Your car has been successfully changed to ' . $car->name . '.');
    }

    public function render()
    {
        return view('livewire.community.event.driver-entrant-options');
    }
}
