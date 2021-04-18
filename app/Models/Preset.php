<?php

namespace App\Models;

/**
 * @property mixed data
 */
class Preset extends BaseModel
{
    public $timestamps = false;

    public function getDataAttribute($value)
    {
        return json_decode($value);
    }
}
