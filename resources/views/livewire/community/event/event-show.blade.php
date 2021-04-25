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

        @if($event->teamEvent)
            <livewire:community.event.team-entrant-options :event="$event" />
            <x-registered-teams-table :event="$event"/>
        @else
            <livewire:community.event.driver-entrant-options :event="$event" />
            <x-registered-drivers-table :event="$event" />
        @endif

    </x-row>

</div>
