<?php

namespace Tests\Feature;

use App\Homeless\CreateTestingDataFromResultsFile;
use App\Models\Community;
use App\Models\RaceEvent;
use Tests\TestCase;

class CreateTestingDataFromResultsFileTest extends TestCase
{
    /** @test */
    public function it_works()
    {
        $creator = new CreateTestingDataFromResultsFile('201002_211430_R.json');
        $this->assertNotNull($creator->resultsObj);


        $creator->buildCarList();
        $this->assertGreaterThan(0, $creator->cars->count());
        $carCount = $creator->cars->count();


        $creator->buildDriversArray();
        $this->assertGreaterThan(0, $creator->drivers->count());
        $driverCount = $creator->drivers->count();


        $creator->createNeededUsers();
        $this->assertGreaterThan(0, $creator->users->count());
        $this->assertCount($driverCount, $creator->users);


        $creator->createCommunity();
        $this->assertInstanceOf(Community::class, $creator->community);
        $this->assertCount($driverCount, $creator->community->members);


        $creator->createEvent();
        $this->assertInstanceOf(RaceEvent::class, $creator->event);
        $this->assertTrue($creator->event->community->is($creator->community));
        $this->assertEquals($creator->resultsObj->trackName, $creator->event->track);


        $creator->assignAvailableCars();
        $uniqueCarCount = $creator->cars->pluck('carModel')->unique()->count();
        $this->assertCount($uniqueCarCount, $creator->event->availableCars);


        $creator->createEventEntries();
        $this->assertCount($carCount, $creator->event->entries);
        $this->assertCount($carCount, $creator->entries);
        foreach ($creator->event->entries as $entry) {
            $this->assertGreaterThan(0, $entry->users->count());
        }
    }

    /**
     * @test
     * Runs all assertions as above ensuring everything is called on run().
     */
    public function it_works_on_run()
    {
        $creator = new CreateTestingDataFromResultsFile('201002_211430_R.json');
        $this->assertNotNull($creator->resultsObj);


        $creator->run();


        $this->assertGreaterThan(0, $creator->cars->count());
        $carCount = $creator->cars->count();
        $this->assertGreaterThan(0, $creator->drivers->count());
        $driverCount = $creator->drivers->count();
        $this->assertGreaterThan(0, $creator->users->count());
        $this->assertCount($driverCount, $creator->users);
        $this->assertInstanceOf(Community::class, $creator->community);
        $this->assertCount($driverCount, $creator->community->members);
        $this->assertInstanceOf(RaceEvent::class, $creator->event);
        $this->assertTrue($creator->event->community->is($creator->community));
        $this->assertEquals($creator->resultsObj->trackName, $creator->event->track);
        $uniqueCarCount = $creator->cars->pluck('carModel')->unique()->count();
        $this->assertCount($uniqueCarCount, $creator->event->availableCars);
        $this->assertCount($carCount, $creator->event->entries);
        $this->assertCount($carCount, $creator->entries);
        foreach ($creator->event->entries as $entry) {
            $this->assertGreaterThan(0, $entry->users->count());
        }
    }
}
