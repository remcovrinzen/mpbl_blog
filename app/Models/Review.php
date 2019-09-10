<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\ReviewFilter;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Review extends Model
{
    use Cachable;

    protected $table = 'reviews';
    protected $primaryKey = 'review_id';

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return (new ReviewFilter($request))->filter($builder);
    }
}
