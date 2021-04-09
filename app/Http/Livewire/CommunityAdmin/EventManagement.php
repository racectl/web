<?php

namespace App\Http\Livewire\CommunityAdmin;

use App\Actions\CreateAccEvent\AccEventSelectedPresets;
use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Http\Livewire\BetterComponent;
use App\Http\Livewire\RuleBasedInputs;
use App\Models\Community;

class EventManagement extends BetterComponent
{
    use RuleBasedInputs;

    public $community;

    public $showCreate = true;

    protected $rules = [
        'newEventName'        => 'required|max:256',
        'availableCarsPreset' => 'nullable|in:accGt3s,accGt4s',
        'weatherPreset'       => 'nullable|exists:acc_weather_presets,id',
        'assistRulesPreset'   => 'nullable|exists:acc_assist_rules,id',
        'track'               => 'required|exists:tracks,game_config_id'
    ];

    public function mount(Community $community): void
    {
        $this->community = $community;
    }

    protected function inputDefaults()
    {
        $this->setInputDefault('weatherPreset', 1);
        $this->setInputDefault('assistRulesPreset', 3);
    }

    public function createNewEvent(
        CreateAccEventAction $createAccEventAction,
        AccEventSelectedPresets $presets
    ): void
    {
        $this->validate();

        $presets->availableCars = $this->input('availableCarsPreset');
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
