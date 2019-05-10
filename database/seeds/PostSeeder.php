<?php

use App\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::table('posts')->delete();
        $reader = new XMLReader();

        $reader->open($xmlFilePath);

        $postsBuffer = [];

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
                if (count($postsBuffer) === $this->bufferSize) {
                    Post::insert($postsBuffer);
                    $postsBuffer = [];
                }
            }
        }
        Post::insert($postsBuffer);
    }
}
