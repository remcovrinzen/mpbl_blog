<?php

namespace App\Models;

use App\Filters\PostFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Carbon\Carbon;

class Post extends Model
{
    use Cachable;

    protected $table = 'posts';
    protected $appends = ['content_summary', 'display_published'];
    protected $primaryKey = 'post_id';

    public function getContentSummaryAttribute()
    {
        return substr($this->attributes['content'], 0, 500);
    }

    public function getDisplayPublishedAttribute()
    {
        $carbonPublished = Carbon::parse($this->attributes['published']);
        return $carbonPublished->format('d F, Y');
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return (new PostFilter($request))->filter($builder);
    }

    public function review()
    {
        return $this->hasOne('App\Models\Review', 'post_id');
    }
}
