<div>
    @foreach($sessions as $session)
        <livewire:community-admin.event-management.individual-acc-event-session
            :session="$session"
            :key="Hash::make($session->id)"
        />
    @endforeach

    <x-row>
        <div class="col-xl-6">
            <button wire:click="addQuali" class="btn btn-success btn-block">Add Qualification</button>
        </div>
        <div class="col-xl-6">
            <button wire:click="addRace" class="btn btn-success btn-block">Add Race</button>
        </div>
    </x-row>
</div>
