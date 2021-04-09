<?php


function results_file($fileName): string
{
    return app()->basePath('jsons\results\\' . $fileName);
}

function convertResultsFileEncodingAndWrite($fileName, $fileContents)
{
    $pathToWrite = results_file('c'.$fileName);
    $converted = iconv('UTF-16LE', 'UTF-8', $fileContents);

    file_put_contents($pathToWrite, $converted);

    return $converted;
}

function getResultsObjectFromFile($fileName)
{
    $convertedFilePath = results_file('c'.$fileName);
    if (file_exists($convertedFilePath)) {
        return json_decode(
            file_get_contents($convertedFilePath)
        );
    }

    $fileContents = file_get_contents(
        results_file($fileName)
    );

    $fileContents = convertResultsFileEncodingAndWrite($fileName, $fileContents);

    return json_decode($fileContents);
}
