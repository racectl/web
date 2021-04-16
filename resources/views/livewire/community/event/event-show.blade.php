<div>
    <x-event-registration />
    @if($event->teamEvent)
        <x-registered-teams-table />
    @else
        <x-registered-drivers-table />
    @endif

</div>
