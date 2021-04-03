<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int                id
 * @property string             name
 * @property string             sim
 * @property string             track
 * @property AccConfig          accConfig
 * @property Community          community
 * @property EloquentCollection entries
 * @property EloquentCollection availableCars
 */
class RaceEvent extends BaseModel
{
    public static function rules(): array
    {
        return [
            'track' => 'required|exists:App\Models\Track,game_config_id',
            'name'  => 'required'
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

    public function availableCars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class);
    }

    public function adminAvailableCarsLink(): string
    {
        return route('communityAdmin.EventManagement.availableCars', [
            'community' => $this->community,
            'event'     => $this
        ]);
    }

    public function showLink(): string
    {
        return route('community.event.show', [
            'community' => $this->community,
            'event' => $this
        ]);
    }

    public function startDate(): string
    {
        return 'Some Date and Time';
    }
}
