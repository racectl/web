<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Configs\ACC\AccAssistRules;
use App\Models\RaceEvent;

class PipeCreateAccAssistRules
{
    protected AccEventSelectedPresets $presets;

    public function __construct(AccEventSelectedPresets $presets)
    {
        $this->presets = $presets;
    }

    public function handle(RaceEvent $event, $next)
    {
        $assistRules = empty($this->presets->assistRules)
            ? new AccAssistRules
            : $this->presets->assistRules->replicate();

        $event->accConfig->assistRules()->save($assistRules);

        return $next($event);
    }
}
