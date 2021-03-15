<?php

namespace App\Models\Configs\ACC;

use App\Actions\GenerateJsonForFile;
use App\Contracts\Jsonable;
use App\Models\BaseModel;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * @property integer qualifyStandingType Options: 1,2
 * @property integer pitWindowLengthSec
 * @property integer driverStintTimeSec
 * @property integer mandatoryPitstopCount
 * @property integer maxTotalDrivingTime
 * @property integer maxDriversCount
 * @property boolean isRefuellingAllowedInRace
 * @property boolean isRefuellingTimeFixed
 * @property boolean isMandatoryPitstopRefuellingRequired
 * @property boolean isMandatoryPitstopTyreChangeRequired
 * @property boolean isMandatoryPitstopSwapDriverRequired
 * @property integer tyreSetCount        Value between 0 and 50
 */
class AccEventRules extends BaseModel implements Jsonable
{
    public $timestamps = false;

    public $jsonableExcludes = [
        'id',
        'acc_config_id'
    ];

    protected $casts = [
        'is_refuelling_allowed_in_race' => 'boolean',
        'is_refuelling_time_fixed' => 'boolean',
        'is_mandatory_pitstop_refuelling_required' => 'boolean',
        'is_mandatory_pitstop_tyre_change_required' => 'boolean',
        'is_mandatory_pitstop_swap_driver_required' => 'boolean',
    ];

    public static function rules(): array
    {
        return [
            'qualifyStandingType'                  => Rule::in([1, 2]),
            'pitWindowLengthSec'                   => 'integer',
            'driverStintTimeSec'                   => 'integer',
            'mandatoryPitstopCount'                => 'integer',
            'maxTotalDrivingTime'                  => 'integer',
            'maxDriversCount'                      => 'integer', //TODO: Custom rule between - max set via track
            'isRefuellingAllowedInRace'            => 'boolean',
            'isRefuellingTimeFixed'                => 'boolean',
            'isMandatoryPitstopRefuellingRequired' => 'boolean',
            'isMandatoryPitstopTyreChangeRequired' => 'boolean',
            'isMandatoryPitstopSwapDriverRequired' => 'boolean',
            'tyreSetCount'                         => 'integer|between:0,50',
        ];
    }

    public function jsonForFile()
    {
        foreach ($this->attributes as $key => $value) {
            if (Str::startsWith($key, 'is')) {
                $this->attributes[$key] = (boolean) $value;
            }
        }
        return GenerateJsonForFile::fromModel($this);
    }
}
