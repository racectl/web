<x-widget heading="Team Registration">
    <x-form.event-available-cars-dropdown />
    <x-form.text wireTo="teamName" labeled="Team Name" />
    <button class="btn btn-primary btn-block">Register For Event</button>
</x-widget>

<x-widget heading="Join Team">
    <x-form.text wireTo="teamJoinCode" labeled="Team Registration Code" />
    <button class="btn btn-primary btn-block">Register For Event</button>
</x-widget>

<x-widget heading="Driver Registration">
    <x-form.event-available-cars-dropdown />
    <button class="btn btn-primary btn-block">Register For Event</button>
</x-widget>

<x-widget heading="Change Registration">
    <x-form.event-available-cars-dropdown />
    <button class="btn btn-primary btn-block">Update Car</button>
    <button class="btn btn-danger btn-block">Unregister</button>
</x-widget>

<x-input-dump />
