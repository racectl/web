@if(!$this->event->teamEvent)
    @if(!$this->event->userIsRegistered())
        <x-widget heading="Driver Registration">
            <x-form.event-available-cars-dropdown />
            <button wire:click="registerUser" class="btn btn-primary btn-block">Register For Event</button>
        </x-widget>
    @else
        <x-widget heading="Change Registration">
            <x-form.event-available-cars-dropdown />
            <button class="btn btn-primary btn-block">Update Car</button>
            <button class="btn btn-danger btn-block">Unregister</button>
        </x-widget>
    @endif
@else
    <x-widget heading="Team Registration">
        <select wire:model="input.joinExistingTeam" class="form-control">
            <option value="0">Register New Team</option>
            <option value="1">Join an Existing Team</option>
        </select>
        <hr>
        @if($this->input['joinExistingTeam'])
            <x-form.text wireTo="teamJoinCode" labeled="Team Registration Code" />
        @else
            <x-form.event-available-cars-dropdown />
            <x-form.text wireTo="teamName" labeled="Team Name" />
        @endif
        <button class="btn btn-primary btn-block">Register For Event</button>
    </x-widget>
@endif


<x-input-dump />
