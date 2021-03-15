<?php


namespace App\Actions\CreateAccEvent;


use App\Models\AccConfig;
use App\Models\RaceEvent;

class CreateAccConfigPipe
{
    public function handle(RaceEvent $event, $next)
    {
        $event->accConfig()->save(new AccConfig);

        return $next($event);
    }
}
