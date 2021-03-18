<div>
    <x-widget heading="Create New Community">
        <form wire:submit.prevent="createNewCommunity">
            <x-form.text labeled="New Community Name" wireTo="newCommunityName" />
            <button type="submit" class="btn btn-block btn-outline-primary">Create</button>
        </form>
    </x-widget>

    <x-widget heading="Communities">
        @foreach($communities as $community)
            {{ $community->name }}
        @endforeach
    </x-widget>
</div>
