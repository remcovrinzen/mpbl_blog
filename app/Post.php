<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $appends = ['content_summary'];
    
    public function getContentSummaryAttribute()
    {
        return substr($this->attributes['content'], 0, 500);
    }
}
