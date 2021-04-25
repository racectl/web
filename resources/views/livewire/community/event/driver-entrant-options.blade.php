<x-widget :heading="$event->userIsRegistered() ? 'Change Registration' : 'Register'">
    @if($event->userIsRegistered())
        <x-form.event-available-cars-dropdown />
        <x-row>
            <div class="col-xl-6">
                <button wire:click="changeCar" class="btn btn-primary btn-block">Update Car</button>
            </div>
            <div class="col-xl-6">
                <button onclick="confirmWithdraw()" class="btn btn-danger btn-block">Withdraw From Event</button>
            </div>
        </x-row>
    @else
        <x-form.event-available-cars-dropdown />
        <button wire:click="registerUser" class="btn btn-primary btn-block">Register For Event</button>
    @endif

    @push('scripts')
        <script>
            function confirmWithdraw() {
                swal({
                    title: 'Are you sure?',
                    text: "This will permanently withdraw you from the event.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Withdraw',
                    padding: '2em'
                }).then(function(result) {
                    if (result.value) {
                        @this.withdrawUser()
                    }
                })
            }
        </script>
    @endpush
</x-widget>
