<?php

namespace App\Models\Configs\ACC;

use App\Actions\GenerateJsonForFile;
use App\Models\BaseModel;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * @property string               serverName
 * @property string|null          adminPassword
 * @property string               carGroup                    Options: "FreeForAll", "GT3", "GT4", "Cup", "ST"
 * @property integer|null         trackMedalsRequirement      Value between 0 and 3
 * @property integer|null         safetyRatingRequirement     Value between -1 and 99
 * @property integer|null         racecraftRatingRequirement  Value between -1 and 99
 * @property string|null          password
 * @property string|null          spectatorPassword
 * @property integer|null         maxCarSlots
 * @property integer|boolean|null dumpLeaderboards
 * @property integer|boolean|null isRaceLocked
 * @property integer|boolean|null randomizeTrackWhenEmpty
 * @property string|null          centralEntryListPath
 * @property integer|boolean|null allowAutoDQ
 * @property integer|null         shortFormationLap
 * @property integer|boolean|null dumpEntryList
 * @property integer|null         formationLapType            Options: 0,1,3
 * @property string               formationLapTypeDescription Computed Property
 *
 */
class AccSettings extends BaseModel implements \App\Contracts\Jsonable
{
    public $timestamps = false;

    public $jsonableExcludes = [
        'id',
        'acc_config_id'
    ];

    public static function rules(): array
    {
        return [
            'serverName'                 => 'required',
            'adminPassword'              => 'nullable',
            'carGroup'                   => [
                'nullable',
                Rule::in(["FreeForAll", "GT3", "GT4", "Cup", "ST"])
            ],
            'trackMedalsRequirement'     => 'nullable|integer|between:0,3',
            'safetyRatingRequirement'    => 'nullable|integer|between:-1,99',
            'racecraftRatingRequirement' => 'nullable|integer|between:-1,99',
            'password'                   => 'nullable',
            'spectatorPassword'          => 'nullable',
            'maxCarSlots'                => 'nullable|integer',
            'dumpLeaderboards'           => 'nullable|boolean',
            'isRaceLocked'               => 'nullable|boolean',
            'randomizeTrackWhenEmpty'    => 'nullable|boolean',
            'centralEntryListPath'       => 'nullable',
            'allowAutoDQ'                => 'nullable|boolean',
            'shortFormationLap'          => 'nullable|boolean',
            'dumpEntryList'              => 'nullable|boolean',
            'formationLapType'           => [
                'nullable',
                Rule::in([0, 1, 3])
            ]
        ];
    }

    public function getFormationLapTypeDescriptionAttribute()
    {
        $descriptions = [
            0 => 'Old limiter lap.',
            1 => 'Free (replaces manual start), only usable for private servers',
            3 => 'Default formation lap with position control and UI.'
        ];

        return $descriptions[$this->formationLapType];
    }

    public function jsonForFile()
    {
        return GenerateJsonForFile::fromModel($this);
    }

}
