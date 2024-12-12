<?php

namespace Differ\Formatters\Plain;

use function Functional\flatten;

function format(array $content): string
{
    $dataDiff = array_filter(flatten(formatData($content)), fn($item) => $item !== null);
    return implode("\n", $dataDiff);
}

function formatData(array $content, string $path = ''): array
{
    return array_map(function ($item) use ($path) {
        $key = $item['key'];
        $type = $item['type'];
        $value = formatValue($item['value']);
        $oldValue = $type === 'changed' ? formatValue($item['oldValue']) : null;
        return match ($type) {
            'added' => "Property '{$path}{$key}' was added with value: {$value}",
            'removed' => "Property '{$path}{$key}' was removed",
            'changed' => "Property '{$path}{$key}' was updated. From {$oldValue} to {$value}",
            'unchanged' => is_array($item['value']) ? formatData($item['value'], "{$path}{$key}.") : null,
            default => throw new \Exception("Unknown type: $type"),
        };
    }, $content);
}

function formatValue(mixed $value): string
{
    if (is_array($value)) {
        return '[complex value]';
    }
    return is_string($value) ? "'{$value}'" : json_encode($value);
}
