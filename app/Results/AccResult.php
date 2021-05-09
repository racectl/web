<?php

namespace App\Results;

use Illuminate\Support\Collection;

class AccResult
{
    public string     $sessionType;
    public string     $sessionTypeString;
    public string     $track_id;
    public int        $sessionIndex;
    public int        $raceWeekendIndex;
    public string     $metaData;
    public string     $serverName;
    public Collection $laps;
    public Collection $serverGivenPenalties;

    public function setSessionType($type): AccResult
    {
        $lookup = [
            'P' => 'Practice',
            'Q' => 'Qualification',
            'R' => 'Race'
        ];

        $this->sessionType       = $type;
        $this->sessionTypeString = $lookup[$type];
        return $this;
    }
}
