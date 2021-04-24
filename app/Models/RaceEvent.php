<?php

namespace App\Models;

use App\CustomCollections\AccEventSessionsCollection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

/**
 * @property int                id
 * @property string             name
 * @property string             sim
 * @property string             track
 * @property int|boolean        teamEvent
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
            'name'  => 'required',
            'sim' => 'required|string|max:3',
            'track' => 'required|exists:App\Models\Track,game_config_id',
            'teamEvent' => 'nullable|boolean'
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
        return route('communityAdmin.eventManagement.availableCars', [
            'community' => $this->community,
            'event'     => $this
        ]);
    }

    public function adminEventSessionsLink(): string
    {
        return route('communityAdmin.eventManagement.eventSessions', [
            'community' => $this->community,
            'event'     => $this
        ]);
    }

    public function adminEventConfigSettingsLink(): string
    {
        return route('communityAdmin.eventManagement.configSettings', [
            'community' => $this->community,
            'event'     => $this
        ]);
    }

    public function getSessions(): AccEventSessionsCollection
    {
        return $this->accConfig->event->accEventSessions;
    }

    public function userIsRegistered(User $user = null)
    {
        $user = $user ?? Auth::user();

        return $this->entries->users()->contains('id', $user->id);
    }

    public function entryForUser(User $user = null)
    {
        $user = $user ?? Auth::user();
        return $this->entries->filter(function ($value) use ($user) {
            return $value->users->contains('id', $user->id);
        })->first();
    }

    public function showLink(): string
    {
        return route('community.event.show', [
            'community' => $this->community,
            'event'     => $this
        ]);
    }

    public function startDate(): string
    {
        return 'Some Date and Time';
    }
}
