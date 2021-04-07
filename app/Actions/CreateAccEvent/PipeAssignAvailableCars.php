<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Car;
use App\Models\RaceEvent;

class PipeAssignAvailableCars
{
    protected AccEventSelectedPresets $presets; //DI from IoC

    public function __construct(AccEventSelectedPresets $presets)
    {
        $this->presets = $presets;
    }

    public function handle(RaceEvent $event, $next)
    {
        if (empty($this->presets->availableCars)) return $next($event);

        if ($this->presets->availableCars == 'accGt3s') {
            foreach (Car::accGt3s()->get() as $car) {
                $event->availableCars()->attach($car);
            }
        }

        if ($this->presets->availableCars == 'accGt3sAndGt4s') {
            foreach (Car::accGt3sAndGt4s()->get() as $car) {
                $event->availableCars()->attach($car);
            }
        }

        if ($this->presets->availableCars == 'accGt4s') {
            foreach (Car::accGt4s()->get() as $car) {
                $event->availableCars()->attach($car);
            }
        }

        if ($this->presets->availableCars == 'accAll') {
            foreach (Car::acc()->get() as $car) {
                $event->availableCars()->attach($car);
            }
        }

        return $next($event);
    }
}
