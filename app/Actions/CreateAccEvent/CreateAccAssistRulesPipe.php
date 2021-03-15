<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Configs\ACC\AccAssistRules;
use App\Models\RaceEvent;

class CreateAccAssistRulesPipe
{
    public function handle(RaceEvent $event, $next)
    {
        $event->accConfig->assistRules()->save(new AccAssistRules);

        return $next($event);
    }
}
