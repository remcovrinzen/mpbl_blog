<?php

namespace App\Http\Controllers;

class Helper
{
    public static function splitSortQuery($sortQuery)
    {
        $splitSortQuery = explode('_', $sortQuery);
        return ['variable' => $splitSortQuery[0], 'way' => $splitSortQuery[1]];
    }

    public static function getDefaultPostSort()
    {
        return ['variable' => "published", 'way' => "desc"];
    }
}
