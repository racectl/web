<?php


namespace App\Actions\CreateAccEvent;

use App\Exceptions\InvalidCarPresetException;
use App\Models\Car;
use App\Models\RaceEvent;

class PipeAssignAvailableCars
{
    protected AccEventSelectedPresets $presets; //DI from IoC

    protected array $builders;

    public function __construct(AccEventSelectedPresets $presets)
    {
        $this->presets = $presets;
        $this->builders = [
            'accGt3s' => Car::accGt3s(),
            'accGt3sAndGt4s' => Car::accGt3sAndGt4s(),
            'accGt4s' => Car::accGt4s(),
            'accAll' => Car::acc(),
        ];
    }

    public function handle(RaceEvent $event, $next)
    {
        if (empty($this->presets->availableCars)) return $next($event);

        throw_if(
            ! array_key_exists($this->presets->availableCars, $this->builders),
            InvalidCarPresetException::class
        );

        $event->availableCars()->attach(
            $this->builders[$this->presets->availableCars]
                ->select('id')
                ->get()
        );

        return $next($event);
    }
}
