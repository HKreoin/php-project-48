<?php

namespace Differ\Differ;

use function Differ\Parsers\parse;

function genDiff($filepath1, $filepath2, $format = 'stylish')
{
    $json1 = parse($filepath1);
    $json2 = parse($filepath2);
    $keys = array_keys([...$json1, ...$json2]);
    asort($keys);
    $keys = array_values($keys);
    $resultDiff = [];

    foreach ($keys as $key) {
        $keyExist1 = array_key_exists($key, $json1);
        $keyExist2 = array_key_exists($key, $json2);
        if ($keyExist1 && $keyExist2) {
            if ($json1[$key] === $json2[$key]) {
                $resultDiff[] = "    {$key}: " . getValue($json1, $key);
            } else {
                $resultDiff[] = "  - {$key}: " . getValue($json1, $key);
                $resultDiff[] = "  + {$key}: " . getValue($json2, $key);
            }
        } elseif ($keyExist1) {
            $resultDiff[] = "  - {$key}: " . getValue($json1, $key);
        } else {
            $resultDiff[] = "  + {$key}: " . getValue($json2, $key);
        }
    }

    $resultStr = "{\n" . implode("\n", $resultDiff) . "\n}";

    return $resultStr;
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
