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

    public static function appendAllQueryParams($pager, $parameters)
    {
        foreach ($parameters as $key => $value) {
            if ($key != "page") {
                $pager->appends($key, $value);
            }
        };

        return $pager;
    }
}
