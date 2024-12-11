<?php

namespace Differ\Differ;

use function Differ\Formatters\getFormattedDiff;
use function Differ\Parsers\parse;

function genDiff(string $filepath1, string $filepath2, string $format = 'stylish'): string
{
    $data1 = parse($filepath1);
    $data2 = parse($filepath2);

    $resultDiff = [];

    $resultDiff = getDiff($data1, $data2);
    return getFormattedDiff($resultDiff, $format);
}

function getValue(mixed $value): mixed
{
    if (is_array($value)) {
        return array_map(function ($k, $v) {
            if (is_array($v)) {
                return ['type' => 'unchanged', 'key' => $k, 'value' => getValue($v)];
            } else {
                return ['type' => 'unchanged', 'key' => $k, 'value' => $v];
            }
        }, array_keys($value), $value);
    }
    return $value;
}

function getSortedKeys(array $data1, array $data2): array
{
    $keys = array_keys([...$data1, ...$data2]);
    asort($keys);
    $keys = array_values($keys);
    return $keys;
}

function getDiff(array $data1, array $data2): array
{
    $keys = getSortedKeys($data1, $data2);
    $diff = array_map(function ($key) use ($data1, $data2) {
        $keyExist1 = array_key_exists($key, $data1);
        $keyExist2 = array_key_exists($key, $data2);
        if (!$keyExist2) {
            return [
                'type' => 'removed',
                'key' => $key,
                'value' => getValue($data1[$key])
            ];
        }
        if (!$keyExist1) {
            return [
                'type' => 'added',
                'key' => $key,
                'value' => getValue($data2[$key])
            ];
        }
        if (is_array($data1[$key]) && is_array($data2[$key])) {
            return [
                'type' => 'unchanged',
                'key' => $key,
                'value' => getDiff($data1[$key], $data2[$key])
            ];
        }
        if ($data1[$key] === $data2[$key]) {
            return [
                'type' => 'unchanged',
                'key' => $key,
                'value' => getValue($data1[$key])
            ];
        }
        return [
            'type' => 'changed',
            'key' => $key,
            'oldValue' => getValue($data1[$key]),
            'value' => getValue($data2[$key])
        ];
    }, $keys);
    return $diff;
}
