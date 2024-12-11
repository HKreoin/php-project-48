<?php

namespace Differ\Formatters\Stylish;

function format(array $content): string
{
    return "{\n" . formatData($content) . "\n}";
}

function formatData(array $content, int $level = 0): string
{
    $spaces = str_repeat('    ', $level);
    return implode("\n", array_map(function ($item) use ($spaces, $level) {
        $key = $item['key'];
        $type = $item['type'];
        $value = formatValue($item['value'], $level + 1);
        $oldValue = $type === 'changed' ? formatValue($item['oldValue'], $level + 1) : null;
        return match ($type) {
            'added' => "{$spaces}  + {$key}: {$value}",
            'removed' => "{$spaces}  - {$key}: {$value}",
            'unchanged' => "{$spaces}    {$key}: {$value}",
            'changed' => "{$spaces}  - {$key}: {$oldValue}\n{$spaces}  + {$key}: {$value}",
        };
    }, $content));
}

function formatValue($value, int $level): string
{
    if (is_array($value)) {
        $data = formatData($value, $level);
        $spaces = str_repeat('    ', $level);
        return "{\n{$data}\n{$spaces}}";
    }
    return is_string($value) ? $value : json_encode($value);
}
