<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    protected $fillable = [
        'score', 'body', 'tags', 'accepted'
    ];

    public function parentPost(): BelongsTo
    {
        return $this->belongsTo('App\Post', 'parent_post_id');
    }
}
