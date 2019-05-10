<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = [
        'title', 'score', 'viewCount', 'body', 'tags'
    ];

    public function answers(): HasMany
    {
        return $this->hasMany('App\Answer', 'parent_post_id');
    }
}
