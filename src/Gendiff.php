<?php

namespace Differ\Differ;

use function Differ\Formatters\format;
use function Differ\Parsers\parse;

function genDiff($filepath1, $filepath2, $format = 'stylish')
{
    $data1 = parse($filepath1);
    $data2 = parse($filepath2);

    $resultDiff = [];

    $resultDiff = getDiff($data1, $data2);
    return format($resultDiff, $format);
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

function getSortedKeys($data1, $data2)
{
    $keys = array_keys([...$data1, ...$data2]);
    asort($keys);
    $keys = array_values($keys);
    return $keys;
}

function getDiff($data1, $data2)
{
    $keys = getSortedKeys($data1, $data2);
    $diff = array_map(function ($key) use ($data1, $data2) {
        $keyExist1 = array_key_exists($key, $data1);
        $keyExist2 = array_key_exists($key, $data2);
        if (!$keyExist2) {
            return [
                'type' => 'removed',
                'key' => $key,
                'value' => getValue($data1, $key)
            ];
        } elseif (!$keyExist1) {
            return [
                'type' => 'added',
                'key' => $key,
                'value' => getValue($data2, $key)
            ];
        } elseif ($data1[$key] === $data2[$key]) {
            return [
                'type' => 'unchanged',
                'key' => $key,
                'value' => getValue($data1, $key)
            ];
        } else {
            return [
                'type' => 'changed',
                'key' => $key,
                'value1' => getValue($data1, $key),
                'value2' => getValue($data2, $key)
            ];
        }
    }, $keys);
    return $diff;
}
