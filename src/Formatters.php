<?php

namespace Differ\Formatters;

function format($content, $format = 'stylish')
{
    $result = [];

    $decore = [
        'stylish' => [
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
        ]
    ];

    $diff = array_map(fn($item) => $decore[$format][$item['type']]($item), $content);

    if ($format === 'stylish') {
        $result = "{\n" . implode("\n", $diff) . "\n}";
    }

    return $result;
}
