<?php


namespace App\Presets;


use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Preset;

class AccAssistRulesPreset
{
    public int  $stabilityControlLevelMax;
    public bool $disableAutosteer;
    public bool $disableAutoLights;
    public bool $disableAutoWiper;
    public bool $disableAutoEngineStart;
    public bool $disableAutoPitLimiter;
    public bool $disableAutoGear;
    public bool $disableAutoClutch;
    public bool $disableIdealLine;

    public function __construct(Preset $db)
    {
        $this->stabilityControlLevelMax = $db->data->stabilityControlLevelMax;
        $this->disableAutosteer         = $db->data->disableAutosteer;
        $this->disableAutoLights        = $db->data->disableAutoLights;
        $this->disableAutoWiper         = $db->data->disableAutoWiper;
        $this->disableAutoEngineStart   = $db->data->disableAutoEngineStart;
        $this->disableAutoPitLimiter    = $db->data->disableAutoPitLimiter;
        $this->disableAutoGear          = $db->data->disableAutoGear;
        $this->disableAutoClutch        = $db->data->disableAutoClutch;
        $this->disableIdealLine         = $db->data->disableIdealLine;
    }

    public function create()
    {
        return AccAssistRules::create([
            'stability_control_level_max' => $this->stabilityControlLevelMax,
            'disable_autosteer'           => $this->disableAutosteer,
            'disable_auto_lights'         => $this->disableAutoLights,
            'disable_auto_wiper'          => $this->disableAutoWiper,
            'disable_auto_engine_start'   => $this->disableAutoEngineStart,
            'disable_auto_pit_limiter'    => $this->disableAutoPitLimiter,
            'disable_auto_gear'           => $this->disableAutoGear,
            'disable_auto_clutch'         => $this->disableAutoClutch,
            'disable_ideal_line'          => $this->disableIdealLine
        ]);
    }
}
