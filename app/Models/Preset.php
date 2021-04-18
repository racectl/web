<?php

namespace App\Models;

use App\Presets\AccAssistRulesPreset;

/**
 * @property mixed data
 */
class Preset extends BaseModel
{
    public $timestamps = false;

    public function scopeAccAssistRules($query)
    {
        return $query->whereType(AccAssistRulesPreset::class);
    }

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }
}
