<?php

namespace App\Http\Controllers;

use App\Actions\ImportAccResults\ResultsMapper;
use App\Homeless\RaceTime;
use App\Http\Livewire\CommunityAdmin\EventManagement\IndividualAccEventSession;
use App\Models\Configs\ACC\AccEventSession;
use Livewire\Livewire;
use Tests\Feature\ActionPipelines\ImportAccResults\ResultsMapperTest;

class DevController extends Controller
{
    public function index()
    {

    }

    public function indexTimeTesting()
    {
        $obj = getResultsObjectFromFile('201002_211430_R.json');

        $laps = collect($obj->laps);
        $time = 0;
        $i = 1;
        foreach ($laps->where('carId', 1002) as $lap) {
            if ($i) $time += $lap->laptime;
            $i++;
        }
        $timeMinusFirst = $time - $laps->where('carId', 1002)->first()->laptime;
//        dump('Adding Laps', (new RaceTime($time))->withHour());
//        dump('Adding Laps, skip first', (new RaceTime($timeMinusFirst))->withHour());
//        dump('Total Time', (new RaceTime($obj->sessionResult->leaderBoardLines[0]->timing->totalTime))->withHour());
//        dd('Driver Total Times', (new RaceTime($obj->sessionResult->leaderBoardLines[0]->driverTotalTimes[0]))->withHour());
        foreach ($obj->sessionResult->leaderBoardLines as $line) {
            $total = $line->timing->totalTime;
//            dump($total / 1000);
            $actualTotal = $line->driverTotalTimes[0];
            dump(($total - $actualTotal) / 1000);
        }
    }

    public function tindex()
    {
        $mapper = new ResultsMapper('201002_211430_R.json');
        dd(
            $mapper,
        );
    }
}
