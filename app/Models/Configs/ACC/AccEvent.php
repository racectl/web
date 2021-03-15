<?php

namespace App\Models\Configs\ACC;

use App\CustomCollections\AccEventSessionsCollection;
use App\Models\AccConfig;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property string                     track
 * @property integer                    preRaceWaitingTimeSeconds
 * @property integer                    sessionOverTimeSeconds
 * @property integer                    ambientTemp
 * @property mixed                      cloudLevel        Value between 0.00 and 1.00
 * @property mixed                      rain              Value between 0.00 and 1.00
 * @property integer                    weatherRandomness Value Between 0 and 7
 * @property integer                    configVersion
 * @property integer                    postQualySeconds
 * @property integer                    postRaceSeconds
 * @property string                     metaData
 * @property integer|boolean            simracerWeatherConditions
 * @property integer|boolean            isFixedConditionQualification
 * @property AccEventSessionsCollection accEventSessions
 * @property AccConfig                  accConfig
 */
class AccEvent extends BaseModel
{
    public $timestamps = false;

    public static function rules(): array
    {
        return [
            'preRaceWaitingTimeSeconds'     => 'nullable|integer',
            'sessionOverTimeSeconds'        => 'nullable|integer',
            'ambientTemp'                   => 'nullable|integer', //TODO: Needs Between
            'cloudLevel'                    => 'nullable|between:0,100',
            'rain'                          => 'nullable|between:0,100',
            'weatherRandomness'             => 'nullable|integer|between:0,7',
            'configVersion'                 => 'nullable|integer',
            'postQualySeconds'              => 'nullable|integer',
            'postRaceSeconds'               => 'nullable|integer',
            'metaData'                      => 'nullable',
            'simracerWeatherConditions'     => 'nullable|boolean',
            'isFixedConditionQualification' => 'nullable|boolean',
        ];
    }

    public function accConfig(): BelongsTo
    {
        return $this->belongsTo(AccConfig::class);
    }

    public function accEventSessions(): HasMany
    {
        return $this->hasMany(AccEventSession::class);
    }

    public function jsonForFile()
    {
        $changeToDecimal = collect(['cloud_level', 'rain']);

        $collection = collect($this->attributes);
        $collection->put(
            'sessions', $this->getSessionsForJson()
        )->prepend(
            $this->accConfig->raceEvent->track, 'track'
        );

        return $collection
                ->except('id', 'force_entry_list', 'acc_config_id')
                ->mapWithKeys(function ($value, $key) use ($changeToDecimal) {
                    if ($changeToDecimal->contains($key)) {
                        $value = $value / 100;
                    }
                    return [Str::camel($key) => $value];
                })
                ->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
    }

    protected function getSessionsForJson()
    {
        return $this->accEventSessions->transform(function ($session) {
            return collect($session)
                ->except(['id', 'acc_event_id'])
                ->mapWithKeys(function ($value, $key) {
                    return [Str::camel($key) => $value];
                });
        });
    }
}
