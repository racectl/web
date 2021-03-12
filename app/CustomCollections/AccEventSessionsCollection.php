<?php


namespace App\CustomCollections;


use App\Exceptions\InvalidEventSessionsException;

class AccEventSessionsCollection extends \Illuminate\Database\Eloquent\Collection
{
    public function allForFinalBuild()
    {
        throw_unless($this->valid(), InvalidEventSessionsException::class);
        return $this;
    }

    protected function valid()
    {
        //There must be at least one non race session for the config to be valid.
        return $this->reject(function ($eventSession) {
            return $eventSession->sessionType == 'R';
        })->count();
    }
}
