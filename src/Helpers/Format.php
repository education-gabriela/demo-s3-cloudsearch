<?php

namespace Gabidavila\S3cloudsearch\Helpers;

class Format
{
    public static function convertDateToUnix($str)
    {
        $date = new \DateTime($str);

        return $date->format('U');
    }
}
