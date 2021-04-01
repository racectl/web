<?php

namespace App\Http\Livewire\CommunityAdmin\EventManagement;

use App\Http\Livewire\RuleBasedInputs;
use App\Models\Car;
use App\Models\Community;
use App\Models\RaceEvent;
use Livewire\Component;

class AccAvailableCars extends Component
{
    use RuleBasedInputs;

    public RaceEvent $event;
    public Community $community;

    protected $rules = [
        'carToAdd' => 'required|exists:cars,id',
        'carToRemove' => 'required|exists:cars,id'
    ];

    public function setDefaults()
    {
        $this->setInputDefault('carToAdd', $this->carsForDropdown()->first()->id);
    }

    public function addAvailableCar()
    {
        $this->validateOnly('carToAdd');

        $car = Car::find($this->input('carToAdd'));
        $this->event->availableCars()->attach($car);

        $this->event->load('availableCars');
    }

    public function setCarToRemove($id)
    {
        $this->setInput('carToRemove', $id);
        $this->removeAvailableCar();
    }

    public function removeAvailableCar()
    {
        $this->validateOnly('carToRemove');

        $car = Car::find($this->input('carToRemove'));
        $this->event->availableCars()->detach($car);

        $this->event->load('availableCars');
    }

    public function render()
    {
        return view('livewire.community-admin.event-management.acc-available-cars')
            ->layout('components.layout', ['title' => $this->community->name . ' - Events'])
            ->with([
                'carsForDropdown' => $this->carsForDropdown()
            ]);
    }

    protected function carsForDropdown()
    {
        $allCars = Car::acc()->get();
        return $allCars->diff($this->event->availableCars);
    }
}
