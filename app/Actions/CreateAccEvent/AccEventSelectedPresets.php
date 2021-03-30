<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Config\ACC\AccWeatherPreset;

class AccEventSelectedPresets
{
    public string $availableCars;
    public AccWeatherPreset $weather;

    public function setWeatherFromId(int $id)
    {
        $this->weather = AccWeatherPreset::find($id);
    }
}
