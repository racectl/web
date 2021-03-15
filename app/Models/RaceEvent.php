<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function entries(): HasMany
    {
        return $this->hasMany(RaceEventEntry::class);
    }

    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }
}
