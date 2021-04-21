<?php

namespace App\Http\Controllers;

use App\Actions\ImportAccResults\ResultsMapper;
use App\Http\Livewire\CommunityAdmin\EventManagement\IndividualAccEventSession;
use App\Models\Configs\ACC\AccEventSession;
use Livewire\Livewire;

class DevController extends Controller
{
    public function index()
    {
        $session = AccEventSession::first();
        dd(Livewire::test(IndividualAccEventSession::class, ['session' => $session])->payload['serverMemo']['data']['input']);
        return view('dev');
    }

    public function tindex()
    {
        $mapper = new ResultsMapper('201002_211430_R.json');
        dd(
            $mapper,
        );
    }
}
