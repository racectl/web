<div>
    @if($showCreate)
        <x-create-acc-event-form />
    @else
        <x-row>
            <div class="col-sm-4 offset-4 mb-2">
                <button class="btn btn-success btn-block" wire:click="$set('showCreate', true)">
                    Create New Event
                </button>
            </div>
        </x-row>
    @endif
    <x-widget heading="Events">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Name</th>
                    <th>Track</th>
                    <th>Car Count</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($community->events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->track }}</td>
                        <td>{{ $event->availableCars->count() }}</td>
                        <td>
                            <a href="{{ $event->adminAvailableCarsLink() }}" class="btn btn-primary">Cars</a>
                            <a href="{{ $event->adminEventSessionsLink() }}" class="btn btn-primary">Sessions</a>
                            <a href="{{ $event->adminEventConfigSettingsLink() }}" class="btn btn-primary">Settings</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-widget>
</div>
