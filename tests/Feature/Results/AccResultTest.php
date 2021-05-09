<?php

namespace Tests\Feature\Results;

use App\Results\AccResult;
use Tests\TestCase;

class AccResultTest extends TestCase
{
    /** @test */
    public function it_sets_the_session_type()
    {
        $accResult = new AccResult();

        $accResult->setSessionType('P');
        $this->assertEquals('P', $accResult->sessionType);
        $this->assertEquals('Practice', $accResult->sessionTypeString);

        $accResult->setSessionType('Q');
        $this->assertEquals('Q', $accResult->sessionType);
        $this->assertEquals('Qualification', $accResult->sessionTypeString);

        $accResult->setSessionType('R');
        $this->assertEquals('R', $accResult->sessionType);
        $this->assertEquals('Race', $accResult->sessionTypeString);
    }

    /** @test */
    public function it_has_properties_assigned_directly()
    {
        $accResult = new AccResult();

        $properties = [
            'track_id',
            'sessionIndex',
            'raceWeekendIndex',
            'metaData',
            'serverName',
            'serverGivenPenalties'
        ];

        foreach ($properties as $property) {
            $this->assertTrue(property_exists($accResult, $property));
        }
    }
}
