<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Config\ACC\AccWeatherPreset;
use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventSession;
use App\Models\RaceEvent;

class PipeCreateAccEventConfigWithPracticeSession
{
    protected AccEventSelectedPresets $presets;

    public function __construct(AccEventSelectedPresets $presets)
    {
        $this->presets = $presets;
    }

    public function handle(RaceEvent $event, $next)
    {
        $accEvent = new AccEvent;

        if (!empty($this->presets->weather)) {
            $weatherPreset = $this->presets->weather;

            $accEvent->ambientTemp = $weatherPreset->ambientTemp;
            $accEvent->cloudLevel = $weatherPreset->cloudLevel;
            $accEvent->rain = $weatherPreset->rain;
            $accEvent->weatherRandomness = $weatherPreset->weatherRandomness;
            $accEvent->simracerWeatherConditions = $weatherPreset->simracerWeatherConditions;
            $accEvent->isFixedConditionQualification = $weatherPreset->isFixedConditionQualification;
        }

        $event->accConfig->event()->save($accEvent);

        $session = AccEventSession::make([
            'hour_of_day' => 14,
            'day_of_weekend' => 1,
            'time_multiplier' => 1,
            'session_type' => 'P',
            'session_duration_minutes' => 10
        ]);

        $accEvent->accEventSessions()->save($session);

        return $next($event);
    }
}
