<?php

namespace App\Http\Livewire\CommunityAdmin;

use App\Actions\CreateAccEvent\AccEventSelectedPresets;
use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Http\Livewire\BetterComponent;
use App\Http\Livewire\RuleBasedInputs;
use App\Models\Community;
use App\Models\Preset;

class EventManagement extends BetterComponent
{
    use RuleBasedInputs;

    public $community;

    public $showCreate = true;

    protected $rules = [
        'newEventName'        => 'required|max:256',
        'availableCarsPreset' => 'nullable|exists:presets,name',
        'weatherPreset'       => 'nullable|exists:acc_weather_presets,id',
        'assistRulesPreset'   => 'nullable|exists:presets,id',
        'track'               => 'required|exists:tracks,game_config_id'
    ];

    public function mount(Community $community): void
    {
        $this->community = $community;
    }

    protected function inputDefaults()
    {
        $this->setInputDefault('weatherPreset', 1);
        $this->setInputDefault(
            'assistRulesPreset',
            Preset::accAssistRules()->first()->id
        );
    }

    public function createNewEvent(
        CreateAccEventAction $createAccEventAction,
        AccEventSelectedPresets $presets
    ): void
    {
        $this->validate();

        $presets->setCarsPresetFromName($this->input('availableCarsPreset'));//TODO: Change from name to ID.
        $presets->setWeatherFromId($this->input('weatherPreset'));
        $presets->setAssistRulesFromId($this->input('assistRulesPreset'));

        $createAccEventAction->execute(
            $this->community,
            $this->input('newEventName'),
            $this->input('track')
        );

        $this->community->refresh();
    }

    public function render()
    {
        return view('livewire.community-admin.event-management')
            ->layout('components.layout', ['title' => $this->community->name . ' - Events']);
    }
}
