<div>
    <x-row>
        <x-widget width="6" heading="Sessions">
            @foreach($event->getSessions() as $session)
                {{ $session->sessionTypeName }}
                {{ $session->dayOfWeekendName }}
                {{ $session->hourOfDay }}:00
                {{ $session->sessionDurationMinutes }} Minutes
            @endforeach
        </x-widget>

        <x-weather-display />

        <x-event-registration />

        @if($event->teamEvent)
            <x-registered-teams-table />
        @else
            <x-registered-drivers-table />
        @endif
    </x-row>
</div>
