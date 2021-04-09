<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DevController extends Controller
{
    public function index()
    {
        $obj = getResultsObjectFromFile('201002_211430_R.json');
//        $obj = $this->getResultsObjectFromFile('utf8converted.json');
        dd($obj);
    }
}
