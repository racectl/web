<x-widget heading="Registered Teams">
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Team Name</th>
                <th>Drivers</th>
                <th>Car</th>
            </tr>
        </thead>
        <tbody>
        @foreach($event->entries as $entry)
            <tr>
                <td>{{ $entry->teamName }}</td>
                <td>
                    @foreach($entry->users as $driver)
                        {{ $driver->displayName }}
                        @if(!$loop->last)<br> @endif
                    @endforeach
                </td>
                <td>{{ $entry->car->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-widget>
