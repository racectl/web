<?php

namespace App\Http\Controllers;

use App\Actions\ImportAccResults\ResultsMapper;

class DevController extends Controller
{
    public function index()
    {
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
