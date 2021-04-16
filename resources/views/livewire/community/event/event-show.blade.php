<div>
    <x-row>
        <x-widget width="6" heading="Sessions">

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
