<?php


namespace App\Repository;


use App\Post;

class ElasticSearchPostSearchRepository implements PostSearchRepository
{
    public function search(string $query)
    {
        return Post::search()
            ->multiMatch(['title', 'body'], $query, ['fuzziness' => 'AUTO'])
            ->sortBy('score')
            ->paginate();
    }
}
