<?php


namespace Tests\Feature;


use App\Repository\ElasticSearchPostSearchRepository;
use Tests\TestCase;

class PostSearchTest extends TestCase
{
    /**
     * @test
     */
    public function itReturnsPosts()
    {
        $postSearchRepository = resolve(ElasticSearchPostSearchRepository::class);

        $result = $postSearchRepository->search('boot');

        $this->assertEquals(2060, $result->totalHits());
        $this->assertEquals($result->maxScore(), $result->first()->documentScore());
    }
}
