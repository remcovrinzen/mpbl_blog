<?php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter
{
    protected $filters = [
        'published' => PublishedFilter::class,
        'rating' => RatingFilter::class, //Lelijk hoort eigenlijk bij ReviewFilter, maar hoe?
        'title' => TitleFilter::class,
        'category' => CategoryFilter::class
    ];
}
