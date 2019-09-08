<?php

namespace App\Filters;

class RatingFilter extends RangeFilter
{
    public function filter($builder, $value)
    {
        $varName = "rating";

        $range = $this->splitRange($value);

        $this->addRangeToBuilder($varName, $range, $builder);
        return $builder;
    }
}
