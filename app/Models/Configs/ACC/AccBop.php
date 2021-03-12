<?php

namespace App\Models\Configs\ACC;

use App\Models\AccConfig;
use App\Models\BaseModel;

/**
 * @property string    track
 * @property integer   carModel
 * @property integer   ballastKg
 * @property integer   restrictor
 * @property AccConfig config
 */
class AccBop extends BaseModel
{
    public $timestamps = false;

    public static function rules(): array
    {
        return [
            'carModel'   => 'required|exists:App\Models\Car,id',
            'ballastKg'  => 'nullable|integer|between:0,100',
            'restrictor' => 'nullable|integer|between:0,20',
        ];
    }

    public function config()
    {
        return $this->belongsTo(AccConfig::class, 'acc_config_id');
    }

    public function getTrackAttribute()
    {
        return $this->config->raceEvent->track;
    }
}
