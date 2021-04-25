<div>
    <x-row>
        <x-widget width="6" heading="Sessions">
            @foreach($event->getSessions() as $session)
                {{ $session->sessionTypeName }}
                {{ $session->dayOfWeekendName }}
                {{ $session->hourOfDay }}:00
                {{ $session->sessionDurationMinutes }} Minutes
            @endforeach
        </x-widget>

        <x-weather-display />

        <x-event-registration />

        @if($event->teamEvent)
            <x-registered-teams-table />
        @else
            <x-registered-drivers-table />
        @endif
    </x-row>

    @push('scripts')
        <script>
            function confirmWithdrawTeam() {
                swal({
                    title: 'Are you sure?',
                    text: "This will permanently withdraw your team from the event.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Withdraw',
                    padding: '2em'
                }).then(function(result) {
                    if (result.value) {
                        @this.withdrawTeam()
                    }
                })
            }
            function confirmLeaveTeam() {
                swal({
                    title: 'Are you sure?',
                    text: "This will permanently withdraw you from your team for the event.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Withdraw',
                    padding: '2em'
                }).then(function(result) {
                    if (result.value) {
                        @this.leaveTeam()
                    }
                })
            }
        </script>
    @endpush
</div>
