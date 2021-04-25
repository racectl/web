<x-widget :heading="$event->userIsRegistered() ? 'Your Team' : 'Team Registration'">
    @if(!$event->userIsRegistered())
        <label for="team-registration-page-type" style="display: none;"></label>
        <select wire:model="input.joinExistingTeam" class="form-control" id="team-registration-page-type">
            <option value="0">Register New Team</option>
            <option value="1">Join an Existing Team</option>
        </select>
        <hr>
        @if($input['joinExistingTeam'])
            <form wire:submit.prevent="joinTeam">
                <x-form.text wireTo="teamJoinCode" labeled="Team Registration Code" />
        @else
            <form wire:submit.prevent="registerNewTeam">
                <x-form.event-available-cars-dropdown />
                <x-form.text wireTo="teamName" labeled="Team Name" />
        @endif
            <button type="submit" class="btn btn-primary btn-block">Register For Event</button>
        </form>
    @else
        <x-row class="text-center">
            <div class="col-xl-4">
                <h5 style="text-decoration: underline;">Members</h5>
                <br>
                @foreach($authEntry->users as $user)
                    <h5>{{ $user->displayName }}</h5>
                @endforeach
            </div>
            <div class="col-xl-4">
                <h5 style="text-decoration: underline;">Join Code</h5>
                <br>
                <h5>{{ $authEntry->teamJoinCode }}</h5>
            </div>
            <div class="col-xl-4">
                <div class="form-group">
                    <label for="first-driver">First To Drive:</label>
                    <select wire:model="input.teamFirstDriver" class="form-control" id="first-driver">
                        @foreach($authEntry->users as $user)
                            <option value="{{ $user->id }}">{{ $user->displayName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-row>
        <hr>
        <x-row>
            <x-team-entrant-options-buttons :authEntry="$authEntry" />
        </x-row>
    @endif

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
                    text: "This will permanently remove you from your team for the event.",
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
</x-widget>
