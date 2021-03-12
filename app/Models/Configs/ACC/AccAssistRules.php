<?php

namespace App\Models\Configs\ACC;

use App\Actions\GenerateJsonForFile;
use App\Contracts\Jsonable;
use App\Models\BaseModel;
use Illuminate\Support\Str;

/**
 * @property integer stabilityControlLevelMax Value between 0 and 100
 * @property boolean disableAutosteer
 * @property boolean disableAutoLights
 * @property boolean disableAutoWiper
 * @property boolean disableAutoEngineStart
 * @property boolean disableAutoPitLimiter
 * @property boolean disableAutoGear
 * @property boolean disableAutoClutch
 * @property boolean disableIdealLine
 */
class AccAssistRules extends BaseModel implements Jsonable
{
    public $timestamps = false;

    public $jsonableExcludes = [
        'id',
        'acc_config_id'
    ];

    public static function rules(): array
    {
        return [
            'stabilityControlLevelMax' => 'required|integer|between:0,100',
            'disableAutosteer'         => 'required|boolean',
            'disableAutoLights'        => 'required|boolean',
            'disableAutoWiper'         => 'required|boolean',
            'disableAutoEngineStart'   => 'required|boolean',
            'disableAutoPitLimiter'    => 'required|boolean',
            'disableAutoGear'          => 'required|boolean',
            'disableAutoClutch'        => 'required|boolean',
            'disableIdealLine'         => 'required|boolean',
        ];
    }

    public function jsonForFile()
    {
        return GenerateJsonForFile::fromModel($this);
    }
}
