<?php


namespace App\Actions\ImportAccResults;


use Illuminate\Support\Collection;

class ResultsMapper
{
    public            $originalObject;
    public array      $laps;
    public Collection $cars;
    public Collection $drivers;
    public            $wasWetSession;

    public function __construct($resultsFileName)
    {
        $results    = getResultsObjectFromFile($resultsFileName);
        $this->laps = $results->laps;
        $this->wasWetSession = (bool) $results->sessionResult->isWetSession;

        $this->originalObject = $results;
        $this->cars           = new Collection;
        $this->mapCars();

        $this->drivers = new Collection;
        $this->mapDrivers();
//        $this->users      = new EloquentCollection;
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
