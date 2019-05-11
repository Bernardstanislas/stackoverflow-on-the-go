<?php

use App\Answer;
use App\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    protected $bufferSize = 100;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $xmlFilePath = $xmlFilePath = dirname(__FILE__) . '/../xml/Posts.xml';
        $reader = new XMLReader();

        $reader->open($xmlFilePath);

        $postsBuffer = [];
        $answersBuffer = [];
        $acceptedAnswerMap = [];

        while ($reader->read()) {
            if ($reader->name === 'row' && $reader->getAttribute('PostTypeId') === '1') {
                array_push($postsBuffer, [
                    'id' => $reader->getAttribute('Id'),
                    'created_at' => Carbon::create($reader->getAttribute('CreationDate')),
                    'updated_at' => Carbon::create($reader->getAttribute('LastEditDate')),
                    'title' => $reader->getAttribute('Title'),
                    'score' => $reader->getAttribute('Score'),
                    'body' => $reader->getAttribute('Body'),
                    'viewCount' => $reader->getAttribute('ViewCount'),
                ]);
                $acceptedAnswerMap[$reader->getAttribute('Id')] = $reader->getAttribute('AcceptedAnswerId');
                if (count($postsBuffer) >= $this->bufferSize) {
                    Post::insert($postsBuffer);
                    $postsBuffer = [];
                    Answer::insert($answersBuffer);
                    $answersBuffer = [];
                    $acceptedAnswerMap = [];
                }
            } elseif ($reader->name === 'row' && $reader->getAttribute('PostTypeId') === '2') {
                $accepted = false;
                if (isset($acceptedAnswerMap[$reader->getAttribute('ParentId')])) {
                    $accepted = $reader->getAttribute('Id') === $acceptedAnswerMap[$reader->getAttribute('ParentId')];
                }
                array_push($answersBuffer, [
                    'id' => $reader->getAttribute('Id'),
                    'created_at' => Carbon::create($reader->getAttribute('CreationDate')),
                    'updated_at' => Carbon::create($reader->getAttribute('LastEditDate')),
                    'score' => $reader->getAttribute('Score'),
                    'body' => $reader->getAttribute('Body'),
                    'accepted' => $accepted,
                    'parent_post_id' => $reader->getAttribute('ParentId')
                ]);
            }
        }
        Post::insert($postsBuffer);
        Answer::insert($answersBuffer);
    }
}
