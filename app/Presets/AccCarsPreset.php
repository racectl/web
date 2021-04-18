<?php


namespace App\Presets;


use App\Models\Preset;

class AccCarsPreset
{
    public $carIds;

    public function __construct(Preset $db)
    {
        $this->carIds = $db->data;
    }
}
