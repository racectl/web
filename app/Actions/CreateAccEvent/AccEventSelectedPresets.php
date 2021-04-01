<?php


namespace App\Actions\CreateAccEvent;


use App\Models\Config\ACC\AccWeatherPreset;

class AccEventSelectedPresets
{
    public ?string $availableCars = null;
    public ?AccWeatherPreset $weather = null;

    public function setWeatherFromId(int $id)
    {
        $this->weather = AccWeatherPreset::find($id);
    }
}
