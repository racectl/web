<x-widget heading="Create New Event">

    <form wire:submit.prevent="createNewEvent">
        <x-form.text labeled="New Event Name" wireTo="newEventName" />

        <x-row>
            <div class="form-group col-xl-4">
                <label>Car Preset</label>
                <select wire:model="input.availableCarsPreset" class="form-control">
                    <option value="">None</option>
                    <option value="accGt3s">GT3s</option>
                    <option value="accGt4s">GT4s</option>
                    <option value="accGt3sAndGt4s">GT3s and GT4s</option>
                    <option value="accAll">All Cars</option>
                </select>
            </div>

            <div class="form-group col-xl-4">
                <label>Weather Preset</label>
                <select wire:model="input.weatherPreset" class="form-control">
                    @foreach(\App\Models\Config\ACC\AccWeatherPreset::all() as $weather)
                        <option value="{{ $weather->id }}">{{ $weather->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-xl-4">
                <label>Assist Rules Preset</label>
                <select wire:model="input.assistRulesPreset" class="form-control">
                    @foreach(\App\Models\Configs\ACC\AccAssistRules::presets() as $preset)
                        <option value="{{ $preset->id }}">{{ $preset->presetName }}</option>
                    @endforeach
                </select>
            </div>
        </x-row>


        <button type="submit" class="btn btn-block btn-outline-primary">Create</button>
    </form>
</x-widget>
