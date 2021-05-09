<?php


namespace App\Results;


use Illuminate\Support\Collection;

class AccResultsMapper
{
    protected           $originalObject;
    protected AccResult $result;

    public array      $laps;
    public Collection $cars;
    public Collection $drivers;
    public            $wasWetSession;

    public function __construct(\stdClass $resultObject, AccResult $result = null)
    {
        $this->result = $result ?? new AccResult();
        $this->originalObject = $resultObject;

        $this->laps          = $resultObject->laps;
        $this->wasWetSession = (bool) $resultObject->sessionResult->isWetSession;
        $this->cars           = new Collection;
        $this->mapCars();
        $this->drivers = new Collection;
        $this->mapDrivers();
//        $this->users      = new EloquentCollection;
    }

    public function getOriginalObject(): \stdClass
    {
        return $this->originalObject;
    }

    public function getMappedResult(): AccResult
    {
        return $this->result;
    }

    public function execute()
    {
        $this->result->setSessionType($this->originalObject->sessionType);
        $this->result->track_id = $this->originalObject->trackName;

        $directMaps = [
            'sessionIndex',
            'raceWeekendIndex',
            'metaData',
            'serverName'
        ];

        foreach ($directMaps as $property) {
            $this->result->$property = $this->originalObject->$property;
        }

        $this->result->laps = collect($this->originalObject->laps);
        $this->result->serverGivenPenalties = collect($this->originalObject->penalties);
    }

    protected function mapCars()
    {
        foreach ($this->originalObject->sessionResult->leaderBoardLines as $line) {
            $this->cars->push($line->car);
        }
    }

    protected function mapDrivers()
    {
        foreach ($this->cars as $car) {
            foreach ($car->drivers as $index => $driver) {

                $driver->index       = $index;
                $driver->carServerId = $car->carId;
                $driver->carModelId  = $car->carModel;

                $this->drivers->push($driver);
            }
        }
    }
}
