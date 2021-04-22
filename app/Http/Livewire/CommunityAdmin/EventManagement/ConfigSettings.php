<?php

namespace App\Http\Livewire\CommunityAdmin\EventManagement;

use App\Http\Livewire\BetterComponent;
use App\Http\Livewire\RuleBasedInputs;
use App\Models\Community;
use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventRules;
use App\Models\Configs\ACC\AccSettings;
use App\Models\RaceEvent;
use Illuminate\Support\Arr;

class ConfigSettings extends BetterComponent
{
    use RuleBasedInputs;
    public Community $community;
    public RaceEvent $event;

    protected $rules;
    protected $models = [
        'assistRules' => AccAssistRules::class,
        'event' => AccEvent::class,
        'eventRules' => AccEventRules::class,
        'settings' => AccSettings::class
    ];
    protected $ignores;

    public function __construct($id = null)
    {
        $this->rules =
            array_merge(
                AccAssistRules::rules(),
                Arr::except(AccEvent::rules(), ['metaData', 'configVersion']),
                AccEventRules::rules(),
                Arr::only(AccSettings::rules(), ['adminPassword', 'password', 'spectatorPassword', 'allowAutoDQ', 'shortFormationLap', 'formationLapType']),
                Arr::only(RaceEvent::rules(), ['name', 'track'])
            );

        $this->ignores = collect([
            'metaData',
            'configVersion',
            'serverName',
            'carGroup',
            'trackMedalsRequirement',
            'safetyRatingRequirement',
            'racecraftRatingRequirement',
            'maxCarSlots',
            'dumpLeaderboards',
            'isRaceLocked',
            'randomizeTrackWhenEmpty',
            'centralEntryListPath',
            'dumpEntryList'
            ]);

        parent::__construct($id);
    }

    protected function setDefaults()
    {
        foreach ($this->models as $configProp => $model) {
            foreach ($model::rules() as $property => $null) {
                if (! $this->ignores->contains($property) )
                $this->setInputDefault($property, $this->event->accConfig->$configProp->$property);
            }
        }
        $this->setInputDefault('name', $this->event->name);
        $this->setInputDefault('track', $this->event->track);
    }

    public function save()
    {
        $this->validate();

        foreach ($this->models as $configProp => $model) {
            foreach ($model::rules() as $property => $null) {
                if (! $this->ignores->contains($property) )
                    $this->event->accConfig->$configProp->$property = $this->input($property);
            }

            $this->event->accConfig->$configProp->save();
        }
        $this->event->name = $this->input('name');
        $this->event->track = $this->input('track');

        $this->event->save();

        $this->success('Saved.', null);
    }

    public function render()
    {
        return view('livewire.community-admin.event-management.config-settings')
            ->layout('components.layout', ['title' => $this->community->name . ' - Config Settings']);
    }
}
