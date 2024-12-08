<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse($filepath)
{
    $filecontent = file_get_contents($filepath);
    if ($filecontent === false) {
        throw new \Exception("File $filepath not found");
    }
    if (preg_match('/json$/', $filepath)) {
        return json_decode($filecontent, true);
    }
    if (preg_match('/ya?ml$/', $filepath)) {
        return Yaml::parse($filecontent);
    }
    if (preg_match('/txt$/', $filepath)) {
        return $filecontent;
    }
}
