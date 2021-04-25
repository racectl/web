<x-widget :heading="$event->userIsRegistered() ? 'Change Registration' : 'Register'">
    @if($event->userIsRegistered())
        <x-form.event-available-cars-dropdown />
        <x-row>
            <div class="col-xl-6">
                <button wire:click="changeCar" class="btn btn-primary btn-block">Update Car</button>
            </div>
            <div class="col-xl-6">
                <button wire:click="withdrawUser" class="btn btn-danger btn-block">Withdraw From Event</button>
            </div>
        </x-row>
    @else
        <x-form.event-available-cars-dropdown />
        <button wire:click="registerUser" class="btn btn-primary btn-block">Register For Event</button>
    @endif
</x-widget>
