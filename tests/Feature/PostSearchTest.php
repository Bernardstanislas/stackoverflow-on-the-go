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

        $this->assertEquals(1036, $result->result()->totalHits());
        $this->assertEquals($result->result()->maxScore(), $result->first()->documentScore);
    }
}
