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
    @if(!$this->event->userIsRegistered())
        <x-widget heading="Team Registration">
            <label for="team-registration-page-type" style="display: none;"></label>
            <select wire:model="input.joinExistingTeam" class="form-control" id="team-registration-page-type">
                <option value="0">Register New Team</option>
                <option value="1">Join an Existing Team</option>
            </select>
            <hr>
            @if($this->input['joinExistingTeam'])
                <form wire:submit.prevent="joinTeam">
                <x-form.text wireTo="teamJoinCode" labeled="Team Registration Code" />
            @else
                <form wire:submit.prevent="registerNewTeam">
                <x-form.event-available-cars-dropdown />
                <x-form.text wireTo="teamName" labeled="Team Name" />
            @endif
                <button type="submit" class="btn btn-primary btn-block">Register For Event</button>
            </form>
        </x-widget>
    @else
        <x-widget heading="Your Team">
            <x-row class="text-center">
                <div class="col-xl-4">
                    <h5 style="text-decoration: underline;">Members</h5>
                    <br>
                    @foreach($this->event->entryForUser()->users as $user)
                        <h5>{{ $user->displayName }}</h5>
                    @endforeach
                </div>
                <div class="col-xl-4">
                        <h5 style="text-decoration: underline;">Join Code</h5>
                        <br>
                        <h5>{{ $this->event->entryForUser()->teamJoinCode }}</h5>
                </div>
                <div class="col-xl-4">
                    <div class="form-group">
                        <label for="first-driver">First To Drive:</label>
                        <select wire:model="input.teamFirstDriver" class="form-control" id="first-driver">
                            @foreach($this->event->entryForUser()->users as $user)
                                <option value="{{ $user->id }}">{{ $user->displayName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </x-row>
            <x-row>
                <div class="col-xl-6">
                    <button wire:click="leaveTeam" class="btn btn-warning btn-block">Leave Team (NP)</button>
                </div>
                <div class="col-xl-6">
                    <button wire:click="withdrawTeam" class="btn btn-danger btn-block">Withdraw Team (NP)</button>
                </div>
            </x-row>
        </x-widget>
    @endif

@endif
