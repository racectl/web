<div>
    <x-widget :heading="$session->sessionTypeName">
        <x-row>

            <div class="form-group col-xl-3">
                <label for="day-of-week">Day of Week</label>
                <select wire:model="input.dayOfWeekend" class="form-control" id="day-of-week">
                    <option value="1">Friday</option>
                    <option value="2">Saturday</option>
                    <option value="3">Sunday</option>
                </select>
            </div>

            <x-form.text wire-to="hourOfDay" class="col-xl-3" />

            <x-form.text wire-to="timeMultiplier" class="col-xl-3" />

            <x-form.text wire-to="sessionDurationMinutes" class="col-xl-3" />

        </x-row>
        @if($modelIsDirty)
            <button wire:click="save" class="btn btn-success btn-block">Save</button>
        @endif
        <button wire:click="delete" class="btn btn-danger btn-block">Delete</button>

    </x-widget>
</div>
