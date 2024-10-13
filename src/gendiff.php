<?php

namespace Differ\Differ;

function genDiff($filepath1, $filepath2, $format = 'stylish'): void
{
    //echo $format . ' ' . $filepath1 . ' ' . $filepath2 . "\n";
    $filecontent1 = file_get_contents(realpath($filepath1));
    $filecontent2 = file_get_contents(realpath($filepath2));
    //echo "{$filecontent1}\n\n{$filecontent2}\n\n";
    $json1 = json_decode($filecontent1, true, 2);
    $json2 = json_decode($filecontent2, true, 2);
    $keys = array_keys([...$json1, ...$json2]);
    asort($keys);
    $keys = array_values($keys);
    $resultDiff = [];
    foreach ($keys as $key) {
        $keyExist1 = array_key_exists($key, $json1);
        $keyExist2 = array_key_exists($key, $json2);
        if ($keyExist1 && $keyExist2) {
            if ($json1[$key] === $json2[$key]) {
                $resultDiff[] = "  {$key}: " . getValue($json1, $key);
            } else {
                $resultDiff[] = "- {$key}: " . getValue($json1, $key);
                $resultDiff[] = "+ {$key}: " . getValue($json2, $key);
            }
        } elseif ($keyExist1) {
            $resultDiff[] = "- {$key}: " . getValue($json1, $key);
        } else {
            $resultDiff[] = "+ {$key}: " . getValue($json2, $key);
        }
    }
    print_r(implode("\n", $resultDiff));
    print_r("\n");
}

function getValue($assoc, $key)
{
    $value = $assoc[$key];
    if ($value == 1) {
        return 'true';
    }
    if ($value == '') {
        return 'false';
    }
    return $value;
}
