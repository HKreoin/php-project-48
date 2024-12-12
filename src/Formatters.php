<?php

namespace Differ\Formatters;

use function Differ\Formatters\Stylish\format as stylishFormat;
use function Differ\Formatters\Plain\format as plainFormat;

function getFormattedDiff(array $content, string $format): string
{
    return match ($format) {
        'stylish' => stylishFormat($content),
        'plain' => plainFormat($content),
        default => throw new \Exception("Unknown format: $format"),
    };
}
