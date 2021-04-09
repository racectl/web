<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DevController extends Controller
{
    public function index()
    {
        $obj = $this->getResultsObjectFromFile('jsons\results\201002_211430_R.json');
        dd($obj->sessionResult);
    }

    public function getResultsObjectFromFile($path)
    {
        return json_decode(
            $this->convertFileEncodingUTF16LE_To_UTF8($path)
        );
    }

    public function convertFileEncodingUTF16LE_To_UTF8($path)
    {
        $location = base_path($path);
        $file = file_get_contents($location);
        return iconv('UTF-16LE', 'UTF-8', $file);
    }
}
