<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse(string $filepath): mixed
{
    $filecontent = file_get_contents($filepath);
    if ($filecontent === false) {
        throw new \Exception("File $filepath not found");
    }
    if (preg_match('/json$/', $filepath) > 0) {
        return json_decode($filecontent, true);
    }
    if (preg_match('/ya?ml$/', $filepath)  > 0) {
        return Yaml::parse($filecontent);
    }
    if (preg_match('/txt$/', $filepath) > 0) {
        return $filecontent;
    }
}
