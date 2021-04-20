<?php

namespace App\Models\Presets;

use App\Models\BaseModel;
use App\Models\Configs\ACC\AccEventRules;
use Illuminate\Support\Arr;

class AccPitConditionsPreset extends BaseModel
{
    public $timestamps = false;

    protected $casts = [
        'is_refuelling_allowed_in_race'             => 'boolean',
        'is_refuelling_time_fixed'                  => 'boolean',
        'is_mandatory_pitstop_refuelling_required'  => 'boolean',
        'is_mandatory_pitstop_tyre_change_required' => 'boolean',
        'is_mandatory_pitstop_swap_driver_required' => 'boolean',
    ];

    public static function rules(): array
    {
        return [
            'name'                                 => 'required|string',
            'community_id'                         => 'integer',
            'pitWindowLengthSec'                   => 'required|integer',
            'driverStintTimeSec'                   => 'required|integer',
            'mandatoryPitstopCount'                => 'required|integer',
            'maxTotalDrivingTime'                  => 'required|integer',
            'isRefuellingAllowedInRace'            => 'required|boolean',
            'isRefuellingTimeFixed'                => 'required|boolean',
            'isMandatoryPitstopRefuellingRequired' => 'required|boolean',
            'isMandatoryPitstopTyreChangeRequired' => 'required|boolean',
            'isMandatoryPitstopSwapDriverRequired' => 'required|boolean',
            'tyreSetCount'                         => 'required|integer|between:0,50',
        ];
    }

    public function makeEventRules()
    {
        $attributes = Arr::except($this->attributes, ['id', 'name', 'community_id']);
        return AccEventRules::make($attributes);
    }
}
