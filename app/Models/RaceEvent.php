<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
 * @property EloquentCollection entries
 * @property string             track
 */
class RaceEvent extends BaseModel
{
    public static function rules(): array
    {
        return [
            'track' => 'required|exists:App\Models\Track,game_config_id',
        ];
    }

    public function entries()
    {
        return $this->hasMany(RaceEventEntry::class);
    }
}
