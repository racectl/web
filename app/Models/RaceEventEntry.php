<?php

namespace App\Models;

use App\CustomCollections\RaceEventEntriesCollection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
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
                $driver["playerID"]       = $user->playerId();
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

    public function newCollection(array $models = [])
    {
        return new RaceEventEntriesCollection($models);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function driver()
    {
        throw_unless($this->users->count() == 1, \Exception::class);
        return $this->users->first();
    }

    public function team()
    {
        throw_unless($this->users->count() > 1, \Exception::class);
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
