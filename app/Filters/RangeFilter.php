<?php

namespace App\Filters;

use Carbon\Carbon;

class RangeFilter
{
    public function splitRange($filterString)
    {
        $splitFilterString = explode('-', $filterString);
        return $splitFilterString;
    }

    public function addRangeToBuilder($varname, $range, $builder)
    {
        if ($range[0] != "" && $range[1] != "") {
            $builder->whereBetween($varname, $range);
        } elseif ($range[0] != "") {
            $builder->where($varname, ">=", $range[0]);
        } elseif ($range[1] != "") {
            $builder->where($varname, "<=", $range[1]);
        }
    }

    public function rangeOfStringsToDates($range)
    {
        foreach ($range as $key => $string) {
            if ($string == '') {
                continue;
            }

            $range[$key] = Carbon::parse($string);
        }

        return $range;
    }
}
