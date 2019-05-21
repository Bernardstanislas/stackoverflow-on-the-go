<?php

namespace App;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use ElasticquentTrait;

    protected $fillable = [
        'title', 'score', 'viewCount', 'body', 'tags'
    ];

    public function answers(): HasMany
    {
        return $this->hasMany('App\Answer', 'parent_post_id');
    }
}
