<?php


namespace App\Homeless;


use App\Models\Community;
use App\Models\RaceEvent;
use App\Models\RaceEventEntry;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CreateTestingDataFromResultsFile
{
    public \stdClass          $resultsObj;
    public Collection         $cars;
    public Collection         $drivers;
    public EloquentCollection $users;
    public Community          $community;
    public RaceEvent          $event;
    public EloquentCollection $entries;

    public function __construct($resultsFileName)
    {
        $this->resultsObj = getResultsObjectFromFile($resultsFileName);
        $this->cars       = new Collection;
        $this->drivers    = new Collection;
        $this->users      = new EloquentCollection;
        $this->entries    = new EloquentCollection;
    }

    public function run()
    {
        $this
            ->buildCarList()
            ->buildDriversArray()
            ->createNeededUsers()
            ->createCommunity()
            ->createEvent()
            ->assignAvailableCars()
            ->createEventEntries();
    }

    public function buildCarList(): CreateTestingDataFromResultsFile
    {
        foreach ($this->resultsObj->sessionResult->leaderBoardLines as $entry) {
            $this->cars->push($entry->car);
        }
        return $this;
    }

    public function buildDriversArray(): CreateTestingDataFromResultsFile
    {
        foreach ($this->cars as $car) {
            foreach ($car->drivers as $driver) {
                if (!$this->drivers->contains('playerId', $driver->playerId)) {
                    $this->drivers->push($driver);
                }
            }
        }
        return $this;
    }

    public function createNeededUsers(): CreateTestingDataFromResultsFile
    {
        foreach ($this->drivers as $driver) {
            $created = User::factory()->create([
                'first_name' => $driver->firstName,
                'last_name'  => $driver->lastName,
                'steam_id'   => Str::after($driver->playerId, 'S'),
            ]);
            $this->users->push($created);
        }

        return $this;
    }

    public function createCommunity(): CreateTestingDataFromResultsFile
    {
        $this->community = Community::factory()->create([
            'name' => 'Testing',
            'slug' => 'testing'
        ]);

        $this->community->members()->attach($this->users);

        return $this;
    }

    public function createEvent(): CreateTestingDataFromResultsFile
    {
        $this->event = RaceEvent::factory()
            ->for($this->community)
            ->create([
                'track' => $this->resultsObj->trackName
            ]);

        return $this;
    }

    public function assignAvailableCars(): CreateTestingDataFromResultsFile
    {
        $this->event->availableCars()->attach(
            $this->cars->pluck('carModel')->unique()
        );

        return $this;
    }

    public function createEventEntries(): CreateTestingDataFromResultsFile
    {
        foreach ($this->cars as $car) {
            $entry = new RaceEventEntry;
            $entry->teamName = $car->teamName;
            $entry->raceNumber = $car->raceNumber;
            $entry->forcedCarModel = $car->carModel;

            $this->event->entries()->save($entry);
            $this->entries->push($entry);

            foreach ($car->drivers as $driver) {
                $user = $this->users->firstWhere(
                    'steam_id',
                    Str::after($driver->playerId, 'S')
                );
                $entry->users()->attach($user);
            }
        }

        return $this;
    }
}
