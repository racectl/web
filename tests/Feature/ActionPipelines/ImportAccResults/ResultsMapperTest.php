<?php

namespace Tests\Feature\ActionPipelines\ImportAccResults;

use App\Results\AccResult;
use App\Results\AccResultsMapper;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ResultsMapperTest extends TestCase
{
    /** @test */
    public function it_works()
    {
        $object = getResultsObjectFromFile('201002_211430_R.json');


        $mapper = new AccResultsMapper($object, new AccResult());
        $this->assertInstanceOf(AccResult::class, $mapper->getMappedResult());
        $this->assertEquals($object, $mapper->getOriginalObject());

        $mapper->execute();
        $mappedResults = $mapper->getMappedResult();


        $this->assertEquals('R', $mappedResults->sessionType);
        $this->assertEquals('nurburgring_2019', $mappedResults->track_id);
        $this->assertEquals(2, $mappedResults->sessionIndex);
        $this->assertEquals(0, $mappedResults->raceWeekendIndex);
        $this->assertEquals('Meta Data', $mappedResults->metaData);
        $this->assertEquals('Server Name', $mappedResults->serverName);
        $this->assertInstanceOf(Collection::class, $mappedResults->laps);
        $this->assertCount(425, $mappedResults->laps);
        $this->assertInstanceOf(Collection::class, $mappedResults->serverGivenPenalties);
        $this->assertCount(2, $mappedResults->serverGivenPenalties);
    }

    /** @test */
    public function it_creates_a_new_acc_result_file_if_one_is_not_passed_in()
    {
        $object = getResultsObjectFromFile('201002_211430_R.json');

        $mapper = new AccResultsMapper($object);

        $this->assertInstanceOf(AccResult::class, $mapper->getMappedResult());
    }

    public function old()
    {
//        $mapper = new AccResultsMapper('201002_211430_R.json');
//        $this->assertNotNull($mapper->originalObject);
//        $this->assertGreaterThan(0, count($mapper->laps));
//        $this->assertGreaterThan(0, $mapper->cars->count());
//        $this->assertGreaterThan(0, $mapper->drivers->count());
//
//        $firstDriver = $mapper->drivers->first();
//        $this->assertNotNull($firstDriver->index);
//        $this->assertNotNull($firstDriver->carServerId);
//        $this->assertNotNull($firstDriver->carModelId);
//
//        $this->assertNotNull($mapper->wasWetSession);
//        $this->assertIsBool($mapper->wasWetSession);
    }
}
