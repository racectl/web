<?php

namespace App\Http\Controllers;

use App\Actions\ImportAccResults\ResultsMapper;
use App\Models\Car;

class DevController extends Controller
{
    public function index()
    {
        $ids = Car::accGt3s()->pluck('id');
        dd($ids);
//        return view('dev');
    }

    public function tindex()
    {
        $mapper = new ResultsMapper('201002_211430_R.json');
        dd(
            $mapper,
        );
    }
}
