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
    $userDefinedMinPostId = $this->ask('What id to you want to start indexing from?');
    $userDefinedMaxPostId = $this->ask('What id to you want to start indexing to?');
    $totalPostCount = 17738709;
    $minPostId = 4;
    $maxPostId = 56412356;

    $approximatePostCount = intval(($userDefinedMaxPostId - $userDefinedMinPostId) * $totalPostCount / ($maxPostId - $minPostId));
    $this->info('Approximately ' . $approximatePostCount . ' posts to index');
    $approximatePostCount = 17738709;
    $chunkNumber = 0;
    $chunkSize = 2000;
    Post::orderBy('id', 'ASC')
        ->where([
            ['id', '>=', $userDefinedMinPostId],
            ['id', '<', $userDefinedMaxPostId]
        ])
        ->chunk($chunkSize, function ($posts) use (&$chunkNumber, &$approximatePostCount, &$chunkSize) {
            $this->info(round($chunkNumber * $chunkSize * 100 / $approximatePostCount, 1) . '% done');
            $this->info('Memory used ' . memory_get_usage());
            $timeStarted = microtime(true);
            $posts->addToIndex();
            $this->info('Done with chunk ' . $chunkNumber . ', took ' . (microtime(true) - $timeStarted) . 'ms');
            gc_collect_cycles();
            $chunkNumber++;
        });

    $this->comment('Done indexing posts');
})->describe('Index Posts from database in the Elastic Search index');
