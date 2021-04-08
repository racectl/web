<x-widget heading="Create New Event">

    <form wire:submit.prevent="createNewEvent">
        <x-row>
            <x-form.text class="col-xl-6" labeled="New Event Name" wireTo="newEventName" />

            <div class="form-group col-xl-6">
                <label for="track">Track</label>
                <select id="track" wire:model="input.selectedTrack" class="form-control">
                    <option value="">Tracks Go Here</option>
                </select>
            </div>
        </x-row>

        <x-row>
            <div class="form-group col-xl-4">
                <label for="car">Car Preset</label>
                <select id="car" wire:model="input.availableCarsPreset" class="form-control">
                    <option value="">None</option>
                    <option value="accGt3s">GT3s</option>
                    <option value="accGt4s">GT4s</option>
                    <option value="accGt3sAndGt4s">GT3s and GT4s</option>
                    <option value="accAll">All Cars</option>
                </select>
            </div>

            <div class="form-group col-xl-4">
                <label for="weather">Weather Preset</label>
                <select id="weather" wire:model="input.weatherPreset" class="form-control">
                    @foreach(\App\Models\Config\ACC\AccWeatherPreset::all() as $weather)
                        <option value="{{ $weather->id }}">{{ $weather->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-xl-4">
                <label for="assists">Assist Rules Preset</label>
                <select id="assists" wire:model="input.assistRulesPreset" class="form-control">
                    @foreach(\App\Models\Configs\ACC\AccAssistRules::presets($this->community->id) as $preset)
                        <option value="{{ $preset->id }}">{{ $preset->presetName }}</option>
                    @endforeach
                </select>
            </div>
        </x-row>


        <button type="submit" class="btn btn-block btn-outline-primary">Create</button>
    </form>
</x-widget>
