<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse($filepath)
{
    $filecontent = file_get_contents($filepath);
    if (preg_match('/json$/', $filepath)) {
        return json_decode($filecontent, true, 2);
    }
    if (preg_match('/ya?ml$/', $filepath)) {
        return Yaml::parse($filecontent);
    }
    if (preg_match('/txt$/', $filepath)) {
        return $filecontent;
    }
}