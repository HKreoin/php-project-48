<?php

namespace Differ\Formatters;

use function Differ\Formatters\Stylish\format;

function getFormattedDiff($content, $format)
{
    return match ($format) {
        'stylish' => format($content),
        default => throw new \Exception("Unknown format: $format"),
    };
}
