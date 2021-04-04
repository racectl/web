<div class="form-group">
    <label>Select Vehicle</label>
    <select wire:model="input.selectedCar" class="form-control">
        @foreach($this->event->availableCars as $car)
            <option value="{{ $car->id }}">{{ $car->name }}</option>
        @endforeach
    </select>
</div>
