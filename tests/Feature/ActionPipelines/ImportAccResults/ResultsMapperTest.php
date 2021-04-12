<?php

namespace Tests\Feature\ActionPipelines\ImportAccResults;

use App\Actions\ImportAccResults\ResultsMapper;
use Tests\TestCase;

class ResultsMapperTest extends TestCase
{
    /** @test */
    public function it_works()
    {
        $mapper = new ResultsMapper('201002_211430_R.json');
        $this->assertNotNull($mapper->originalObject);
        $this->assertGreaterThan(0, count($mapper->laps));
        $this->assertGreaterThan(0, $mapper->cars->count());
        $this->assertGreaterThan(0, $mapper->drivers->count());

        $firstDriver = $mapper->drivers->first();
        $this->assertNotNull($firstDriver->index);
        $this->assertNotNull($firstDriver->carServerId);
        $this->assertNotNull($firstDriver->carModelId);

        $this->assertNotNull($mapper->wasWetSession);
        $this->assertIsBool($mapper->wasWetSession);
    }
}
