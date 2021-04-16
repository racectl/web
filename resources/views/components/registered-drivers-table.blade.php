<x-widget heading="Registered Drivers">
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Driver</th>
            <th>Car</th>
        </tr>
        </thead>
        <tbody>
        @foreach($this->event->entries as $entry)
            <tr>
                <td>{{ $entry->driver()->displayName }}</td>
                <td>{{ $entry->car->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-widget>
