<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Configs\ACC\AccEventRules;
use App\Models\Configs\ACC\AccSettings;
use App\Models\RaceEvent;

class PipeCreateAccSettings
{
    public function handle(RaceEvent $event, $next)
    {
        $settings = new AccSettings;
        $settings->serverName = $event->name;

        $event->accConfig->settings()->save($settings);

        return $next($event);
    }
}
