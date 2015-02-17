<?php

namespace Gabidavila\S3cloudsearch\Helpers;

use Symfony\Component\Yaml\Parser;

class ConfigParser
{
    public static function buildArray($file, $path = null)
    {
        if (is_null($path)) {
            $path = ROOT . '/config/';
        }

        $file = $path . $file;

        $yaml = new Parser();

        return $yaml->parse(file_get_contents($file));
    }
}
