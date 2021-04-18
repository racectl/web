<?php


namespace App\Actions\CreateAccEvent;

use App\Exceptions\InvalidCarPresetException;
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
        if (empty($this->presets->accCarsPreset)) return $next($event);

        $event->availableCars()->attach(
            $this->presets->accCarsPreset->carIds
        );

        return $next($event);
    }
}
