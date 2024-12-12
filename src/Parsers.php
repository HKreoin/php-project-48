<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse(string $filepath): mixed
{
    try {
        $filecontent = (string) file_get_contents($filepath);
    } catch (\Exception $e) {
        throw new \Exception("File not found: $filepath");
    }
    $extension = explode('.', $filepath)[1];
    return match ($extension) {
        'json' => json_decode($filecontent, true),
        'yml' => Yaml::parse($filecontent),
        'yaml' => Yaml::parse($filecontent),
        'txt' => $filecontent,
        default => throw new \Exception("Unknown extension: $extension"),
    };
}
