<?php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class ReviewFilter extends AbstractFilter
{
    protected $filters = [
        'rating' => RatingFilter::class,
    ];
}
