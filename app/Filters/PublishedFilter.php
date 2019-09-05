<?php

namespace App\Filters;

class PublishedFilter extends RangeFilter
{
    public function filter($builder, $value)
    {
        $varName = "published";

        $range = $this->splitRange($value);
        $range = $this->rangeOfStringsToDates($range);

        $builder = $this->addRangeToBuilder($varName, $range, $builder);
        return $builder;
    }
}
