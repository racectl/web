<?php

namespace App\Models;

use App\CustomCollections\RaceEventEntriesCollection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * @property string             teamName
 * @property string             teamJoinCode
 * @property integer            raceNumber
 * @property integer            forcedCarModel
 * @property integer            defaultGridPosition
 * @property integer            ballastKg
 * @property integer            restrictor
 * @property integer|boolean    overrideDriverInfo
 * @property EloquentCollection users
 * @property RaceEvent          event
 * @property Car                car
 * @property string             carClass
 */
class RaceEventEntry extends BaseModel
{
    public static function rules(): array
    {
        return [
            'teamName'            => 'nullable|string|max:255',
            'teamJoinCode'        => 'nullable|string|max:8|min:8',
            'raceNumber'          => 'nullable|integer|between:1,998',
            'forcedCarModel'      => 'nullable|integer|exists:App\Models\Car,id',
            'defaultGridPosition' => 'nullable|integer',
            'ballastKg'           => 'nullable|integer|between:0,100',
            'restrictor'          => 'nullable|integer|between:0,20',
            'overrideDriverInfo'  => 'nullable|boolean'
        ];
    }

    public static function generateEntryListConfig(RaceEvent $event)
    {
        $array = [];

        foreach ($event->entries as $entry) {
            $entryArray = [];

            foreach ($entry->users as $user) {
                $driver                   = [];
                $driver["firstName"]      = $user->first_name;
                $driver["lastName"]       = $user->last_name;
                $driver["shortName"]      = $user->shortName();
                $driver["driverCategory"] = $user->id;
                $driver["playerID"]       = $user->accPlayerId();
                $entryArray['drivers'][]  = $driver;
            }

            $entryArray["raceNumber"]          = $entry->raceNumber;
            $entryArray["forcedCarModel"]      = $entry->forcedCarModel;
            $entryArray["overrideDriverInfo"]  = $entry->overrideDriverInfo;
            $entryArray["defaultGridPosition"] = $entry->defaultGridPosition;
            $entryArray["ballastKg"]           = $entry->ballastKg;
            $entryArray["restrictor"]          = $entry->restrictor;
            $entryArray["isServerAdmin"]       = $entry->isServerAdmin;

            $array['entries'][] = $entryArray;
        }

        $array['forceEntryList'] = $event->forceEntryList;
        return collect($array)
                ->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            . "\n";
    }

    public function newCollection(array $models = []): RaceEventEntriesCollection
    {
        return new RaceEventEntriesCollection($models);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(RaceEvent::class, 'race_event_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'forced_car_model');
    }

    public function scopeForUserAndEvent($query, $userId, $eventId)
    {
        return $query
            ->whereRaceEventId($eventId)
            ->whereHas('users', function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            });
    }

    public function getCarClassAttribute(): string
    {
        return $this->car->type;
    }

    public function driver()
    {
        return $this->users->first();
    }

    public function team()
    {
        return $this->users;
    }

    public function getIsServerAdminAttribute()
    {
        return 0;
    }

    public function generateTeamJoinCode()
    {
        $this->teamJoinCode = Str::before(Str::uuid(), '-');
        return $this;
    }
}
