<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $table = 'posts';
    protected $appends = ['content_summary', 'display_published'];
    
    public function getContentSummaryAttribute()
    {
        return substr($this->attributes['content'], 0, 500);
    }

    public function getDisplayPublishedAttribute()
    {
        $carbonPublished = Carbon::parse($this->attributes['published']);
        return $carbonPublished->format('d F, Y');
    }
}
