<?php

namespace App\Models;

/**
 * @property string  gameConfigId
 * @property string  name
 * @property string  sim
 * @property integer pitBoxes
 * @property integer maxServerSlots
 */
class Track extends BaseModel
{
    public $timestamps = false;

    public static function rules(): array
    {
        return [
            'gameConfigId'   => 'required',
            'name'           => 'required',
            'sim'            => 'required',
            'pitBoxes'       => 'required',
            'maxServerSlots' => 'required',
        ];
    }
}
