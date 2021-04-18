<?php


namespace App\Actions\CreateAccEvent;


use App\Exceptions\InvalidCarPresetException;
use App\Models\Config\ACC\AccWeatherPreset;
use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Preset;
use App\Presets\AccAssistRulesPreset;
use App\Presets\AccCarsPreset;

class AccEventSelectedPresets
{
    public ?AccCarsPreset        $accCarsPreset = null;
    public ?AccWeatherPreset     $weather       = null;
    public ?AccAssistRulesPreset $assistRules   = null;

    public function setWeatherFromId(int $id): AccEventSelectedPresets
    {
        $this->weather = AccWeatherPreset::find($id);
        return $this;
    }

    public function setAssistRulesFromId(int $id): AccEventSelectedPresets
    {
        $db = Preset::find($id);

        if ($db) {
            $this->assistRules = new AccAssistRulesPreset($db);
        }

        return $this;
    }

    public function setCarsPresetFromName($name): AccEventSelectedPresets
    {
        if (empty($name)) return $this;

        $db = Preset::firstWhere('name', $name);
        throw_if(is_null($db), InvalidCarPresetException::class);
        $this->accCarsPreset = new AccCarsPreset($db);

        return $this;
    }
}
