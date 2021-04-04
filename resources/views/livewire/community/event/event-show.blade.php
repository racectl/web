<div>
    <x-event-registration />

    <x-widget heading="Registered Drivers">
        @foreach($event->entries as $entry)
            {{ $entry->driver()->displayName }}
        @endforeach
    </x-widget>
</div>
