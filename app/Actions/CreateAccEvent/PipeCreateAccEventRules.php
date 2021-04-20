<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Configs\ACC\AccEventRules;
use App\Models\RaceEvent;

class PipeCreateAccEventRules
{
    protected AccEventSelectedPresets $presets;

    public function __construct(AccEventSelectedPresets $presets)
    {
        $this->presets = $presets;
    }

    public function handle(RaceEvent $event, $next)
    {
        $eventRules = empty($this->presets->pitConditions)
            ? new AccEventRules
            : $this->presets->pitConditions->makeEventRules();

        $event->accConfig->eventRules()->save($eventRules);

        return $next($event);
    }
}
