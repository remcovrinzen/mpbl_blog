<?php

namespace App\Filters;

class MultipleFilter
{
    public function splitMultiple($filterString)
    {
        return explode(',', $filterString);
    }

    public function addMultipleToBuilder($multiArray, $varname, $builder)
    {
        $builder->whereIn($varname, $multiArray);
    }
}
