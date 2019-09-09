<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use Cachable;

    protected $table = 'post_categories';
}
