<?php

declare(strict_types=1);
function getCSVDataFromFile(string $path, string $extensions): array {
    $fileCount = (count(glob($path . "*.{{$extensions}}", GLOB_BRACE))) + 1;
    $filePaths = [];
    for ($i = 1; $i < $fileCount; $i++) {
        array_push($filePaths, fopen(FILES_PATH . "sample_$i.csv", 'r'));
    }


    $datas = [];
    foreach ($filePaths as $filePath) {
        while (($data = fgetcsv($filePath)) !== false) {
            array_push($datas, $data);
        }
    }

    return $datas;
}

function stringSeparator(string $rawString, array $seperators):string {
    $string = $rawString;
    foreach ($seperators as $seperator) {
        $tempString = explode($seperator, $string);
        if (count($tempString) > 1) {
            $string = $tempString[0] . $tempString[1];
        } else {
            $string = $tempString[0];
        }
    }

    return $string;
}

function dateFormatter(string $stringDate, string $format = null):string
{
    if ($format == null) {
        $format = "M d, Y";
    }

    $date = date($format, strtotime($stringDate));
    return $date;
}