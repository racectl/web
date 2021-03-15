<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Configs\ACC\AccEventRules;
use App\Models\RaceEvent;

class CreateAccEventRulesPipe
{
    public function handle(RaceEvent $event, $next)
    {
        $event->accConfig->eventRules()->save(new AccEventRules);

        return $next($event);
    }
}
