<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property EloquentCollection entries
 * @property string             name
 * @property string             track
 * @property AccConfig          accConfig
 */
class RaceEvent extends BaseModel
{
    public static function rules(): array
    {
        return [
            'track' => 'required|exists:App\Models\Track,game_config_id',
            'name' => 'required'
        ];
    }

    public function entries(): HasMany
    {
        return $this->hasMany(RaceEventEntry::class);
    }

    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }

    public function accConfig(): HasOne
    {
        return $this->hasOne(AccConfig::class);
    }


}
