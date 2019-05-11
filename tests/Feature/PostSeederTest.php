<?php


namespace Tests\Feature;


use App\Answer;
use App\Post;
use Tests\TestCase;

class PostSeederTest extends TestCase
{
    /**
     * @test
     */
    public function databaseHasAllTheRecords()
    {
        $this->assertEquals(16825, Post::count());
        $this->assertEquals(23741, Answer::count());
    }
}
