<?php

namespace App\Filters;

class TitleFilter
{
    public function filter($builder, $value)
    {
        $lowercase_value = strtolower($value);
        $builder->whereRaw("LOWER(title) LIKE '%" . $lowercase_value . "%'");
        return $builder;
    }
}
