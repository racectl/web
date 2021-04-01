<div>
    <x-widget heading="Add Car">
        <form wire:submit.prevent="addAvailableCar">
            <select wire:model="input.carToAdd" class="form-control">
                @foreach($carsForDropdown as $car)
                    <option value="{{ $car->id }}">{{ $car->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-success btn-block">Add Car</button>
        </form>
    </x-widget>

    <x-widget heading="Cars Available For Event">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Car</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach($event->availableCars as $car)
                <tr>
                    <td>{{ $car->name }}</td>
                    <td>
                        <button wire:click="setCarToRemove({{ $car->id }})" class="btn btn-danger">
                            Remove
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-widget>
</div>
