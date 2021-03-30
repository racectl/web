<?php

namespace App\Models\Config\ACC;

use App\Models\BaseModel;

/**
 * @property integer         ambientTemp
 * @property mixed           cloudLevel        Value between 0.00 and 1.00
 * @property mixed           rain              Value between 0.00 and 1.00
 * @property integer         weatherRandomness Value Between 0 and 7
 * @property integer|boolean simracerWeatherConditions
 * @property integer|boolean isFixedConditionQualification
 */
class AccWeatherPreset extends BaseModel
{
    public $timestamps = false;

    public static function rules(): array
    {
        return [
            'ambientTemp'                   => 'nullable|integer|between:10,35',
            'cloudLevel'                    => 'nullable|between:0,100',
            'rain'                          => 'nullable|between:0,100',
            'weatherRandomness'             => 'nullable|integer|between:0,7',
            'simracerWeatherConditions'     => 'nullable|boolean',
            'isFixedConditionQualification' => 'nullable|boolean',
        ];
    }
}
