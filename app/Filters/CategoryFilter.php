<?php

namespace App\Filters;

class CategoryFilter extends MultipleFilter
{
    public function filter($builder, $value)
    {
        $varName = 'cat_id';

        $splitValue = $this->splitMultiple($value);
        $this->addMultipleToBuilder($splitValue, $varName, $builder);
        return $builder;
    }
}
