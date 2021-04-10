<?php

namespace App\Http\Controllers;

use App\Homeless\CreateTestingDataFromResultsFile;
use Illuminate\Http\Request;

class DevController extends Controller
{
    public function index()
    {
        $creator = new CreateTestingDataFromResultsFile('201002_211430_R.json');
        $creator->run();
    }
}
