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
        'pitConditionsPreset' => 'nullable|exists:acc_pit_conditions_presets,id',
        'track'               => 'required|exists:tracks,game_config_id',
        'entrantType'         => 'required|boolean'
    ];

    public function mount(Community $community): void
    {
        $this->community = $community;
    }

    protected function inputDefaults()
    {
        $this->setInputDefault('weatherPreset', 1);
        $this->setInputDefault('track', 'barcelona_2020');
        $this->setInputDefault('assistRulesPreset', 3);
        $this->setInputDefault('pitConditionsPreset', 2);
        $this->setInputDefault('entrantType', 0);
    }

    public function createNewEvent(
        CreateAccEventAction $createAccEventAction,
        AccEventSelectedPresets $presets
    ): void
    {
        $this->validate();

        $presets->availableCars = $this->input('availableCarsPreset');
        $presets->setWeatherFromId($this->input('weatherPreset'))
            ->setAssistRulesFromId($this->input('assistRulesPreset'))
            ->setPitConditionsFromId($this->input('pitConditionsPreset'));


        $createAccEventAction->execute(
            $this->community,
            $this->input('newEventName'),
            $this->input('track'),
            $this->input('entrantType')
        );

        $this->community->refresh();
    }

    public function render()
    {
        return view('livewire.community-admin.event-management')
            ->layout('components.layout', ['title' => $this->community->name . ' - Events']);
    }
}
