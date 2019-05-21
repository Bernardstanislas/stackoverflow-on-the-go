<?php

use App\Post;
use Illuminate\Foundation\Inspiring;
use Sleimanx2\Plastic\Facades\Plastic;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('posts:index', function () {
    $this->comment('Starting posts indexation in Elastic Search');
    $this->info(Post::count() . ' posts to index');
    Post::addAllToIndex();
    $this->comment('Done indexing posts');
})->describe('Index Posts from database in the Elastic Search index');
