<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventSession;
use App\Models\RaceEvent;

class CreateAccEventConfigWithPracticeSessionPipe
{
    public function handle(RaceEvent $event, $next)
    {
        /** @var AccEvent $configEvent */
        $configEvent = $event->accConfig->event()->save(new AccEvent);

        $session = AccEventSession::make([
            'hour_of_day' => 14,
            'day_of_weekend' => 1,
            'time_multiplier' => 1,
            'session_type' => 'P',
            'session_duration_minutes' => 10
        ]);

        $saved = $configEvent->accEventSessions()->save($session);

        return $next($event);
    }
}
