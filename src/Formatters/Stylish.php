<?php

namespace Differ\Formatters\Stylish;

function format($content)
{
    $decore = [
        'unchanged' => function ($item) {
            return "    {$item['key']}: {$item['value']}";
        },
        'changed' => function ($item) {
            return "  - {$item['key']}: {$item['value1']}\n  + {$item['key']}: {$item['value2']}";
        },
        'added' => function ($item) {
            return "  + {$item['key']}: {$item['value']}";
        },
        'removed' => function ($item) {
            return "  - {$item['key']}: {$item['value']}";
        },
    ];

    $diff = array_map(fn($item) => $decore[$item['type']]($item), $content);
    $result = "{\n" . implode("\n", $diff) . "\n}";

    return $result;
}
