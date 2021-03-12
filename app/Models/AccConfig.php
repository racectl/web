<?php

namespace App\Models;

use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Configs\ACC\AccBop;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventRules;
use App\Models\Configs\ACC\AccSettings;

/**
 * @property integer|boolean forceEntryList
 * @property AccAssistRules  assistRules
 * @property AccEvent        event
 * @property AccEventRules   eventRules
 * @property AccSettings     settings
 * @property RaceEvent       raceEvent
 */
class AccConfig extends BaseModel
{
    public $timestamps = false;

    public function assistRules()
    {
        return $this->hasOne(AccAssistRules::class);
    }

    public function event()
    {
        return $this->hasOne(AccEvent::class);
    }

    public function eventRules()
    {
        return $this->hasOne(AccEventRules::class);
    }

    public function settings()
    {
        return $this->hasOne(AccSettings::class);
    }

    public function raceEvent()
    {
        return $this->belongsTo(RaceEvent::class);
    }

    public function globalBops()
    {
        return $this->hasMany(AccBop::class);
    }

    public function loadAllConfigs()
    {
        return $this->load([
            'assistRules',
            'event.accEventSessions',
            'eventRules',
            'settings',
            'globalBops'
        ]);
    }

    public function entryListJson()
    {
        return RaceEventEntry::generateEntryListConfig($this->raceEvent);
    }
}
