<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Config\ACC\AccWeatherPreset;
use App\Models\Configs\ACC\AccAssistRules;

class AccEventSelectedPresets
{
    public ?string $availableCars = null;
    public ?AccWeatherPreset $weather = null;
    public ?AccAssistRules $assistRules = null;

    public function setWeatherFromId(int $id)
    {
        $this->weather = AccWeatherPreset::find($id);
    }

    public function setAssistRulesFromId(int $id)
    {
        $this->assistRules = AccAssistRules::find($id);
    }
}
