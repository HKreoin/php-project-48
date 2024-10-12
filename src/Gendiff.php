<?php

namespace App\Gendiff;

function generate($format, $filepath1 , $filepath2): void {
    echo $format . ' ' . $filepath1 . ' ' . $filepath2 . "\n";
    $filecontent1 = file_get_contents(realpath($filepath1));
    $filecontent2 = file_get_contents(realpath($filepath2));
    echo $filecontent1 . "\n" . $filecontent2;
    $json1 = json_decode($filecontent1);
    $json2 = json_decode($filecontent2);
    print_r($json1);
    print_r($json2);
}