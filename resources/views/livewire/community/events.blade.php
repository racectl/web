<div>
    <x-widget heading="Events">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Sim</th>
                    <th>Event</th>
                    <th>Cars</th>
                    <th>Registered</th>
                    <th>Starts</th>
                    <th>Quick Register</th>
                </tr>
            </thead>
            <tbody>
                @foreach($community->events as $event)
                    <tr>
                        <td>{{ $event->sim }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->availableCars->count() }}</td>
                        <td>{{ $event->entries->count() }}</td>
                        <td>{{ $event->startDate() }}</td>
                        <td>
                            <button wire:click="quickRegisterToEvent({{ $event->id }})"
                                    class="btn btn-success btn-block"
                            >
                                Quick Register
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-widget>
</div>
