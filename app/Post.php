<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Sleimanx2\Plastic\Searchable;

class Post extends Model
{
    use Searchable;

    protected $fillable = [
        'title', 'score', 'viewCount', 'body', 'tags'
    ];

    public function answers(): HasMany
    {
        return $this->hasMany('App\Answer', 'parent_post_id');
    }
}
