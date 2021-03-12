<?php

namespace App\Models\Configs\ACC;

use App\CustomCollections\AccEventSessionsCollection;
use App\Models\BaseModel;
use Illuminate\Validation\Rule;

/**
 * @property integer hourOfDay      Value between 0 and 23
 * @property integer dayOfWeekend   Value between 1 and 3
 * @property integer timeMultiplier Value between 0 and 24
 * @property string  sessionType    Options: P, Q, R
 * @property integer sessionDurationMinutes
 */
class AccEventSession extends BaseModel
{
    public $timestamps = false;

    public static function rules(): array
    {
        return [
            'hourOfDay'              => 'required|integer|between:0,23',
            'dayOfWeekend'           => 'required|integer|between:1,3',
            'timeMultiplier'         => 'integer|between:0,24',
            'sessionType'            => [
                'required',
                'string',
                Rule::in(['P', 'Q', 'R'])
            ],
            'sessionDurationMinutes' => 'required|integer'
        ];
    }

    public function newCollection(array $models = [])
    {
        return new AccEventSessionsCollection($models);
    }
}
