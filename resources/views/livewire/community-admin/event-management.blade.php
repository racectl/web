<div>
    <x-widget heading="Create New Event">
        <form wire:submit.prevent="createNewEvent">
            <x-form.text labeled="New Event Name" wireTo="newEventName" />

            <label>Car Preset {{ $input['availableCarsPreset'] }}</label>
            <select wire:model="input.availableCarsPreset" class="form-control">
                <option value="">None</option>
                <option value="accGt3s">All GT3s</option>
                <option value="accGt4s">All GT4s</option>
            </select>

            <label>Weather Preset {{ $input['weatherPreset'] }}</label>
            <select wire:model="input.weatherPreset" class="form-control">
                @foreach(\App\Models\Config\ACC\AccWeatherPreset::all() as $weather)
                    <option value="{{ $weather->id }}">{{ $weather->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-block btn-outline-primary">Create</button>
        </form>
    </x-widget>
    <x-widget heading="Events">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Car Count</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
            @foreach($community->events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->availableCars->count() }}</td>
                        <td>
                            <a href="{{ $event->adminAvailableCarsLink() }}" class="btn btn-primary">Cars</a>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    </x-widget>
</div>
