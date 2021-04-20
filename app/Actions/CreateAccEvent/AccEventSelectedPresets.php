<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Presets\AccPitConditionsPreset;
use App\Models\Presets\AccWeatherPreset;

class AccEventSelectedPresets
{
    public ?string                 $availableCars = null;
    public ?AccWeatherPreset       $weather       = null;
    public ?AccAssistRules         $assistRules   = null;
    public ?AccPitConditionsPreset $pitConditions = null;

    public function setWeatherFromId(int $id): AccEventSelectedPresets
    {
        $this->weather = AccWeatherPreset::find($id);
        return $this;
    }

    public function setAssistRulesFromId(int $id): AccEventSelectedPresets
    {
        $this->assistRules = AccAssistRules::find($id);
        return $this;
    }

    public function setPitConditionsFromId(int $id): AccEventSelectedPresets
    {
        $this->pitConditions = AccPitConditionsPreset::find($id);
        return $this;
    }
}
