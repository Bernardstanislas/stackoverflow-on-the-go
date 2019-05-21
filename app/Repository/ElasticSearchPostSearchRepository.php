<?php


namespace App\Repository;


use App\Post;

class ElasticSearchPostSearchRepository implements PostSearchRepository
{
    public function search(string $query)
    {
        return Post::complexSearch([
            'body' => [
                'query' => [
                    'fuzzy' => [
                        'title' => [
                            'value' => $query,
                            'boost' => 2.0,
                            'fuzziness' => 1
                        ]
                    ],
                    'fuzzy' => [
                        'body' => [
                            'value' => $query,
                            'boost' => 1.0,
                            'fuzziness' => 1
                        ]
                    ],
                ],
                'sort' => [
                    'score' => [
                        'order' => 'desc'
                    ]
                ]
            ]
        ]);
    }
}
