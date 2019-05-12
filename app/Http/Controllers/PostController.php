<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    public function show(int $id)
    {
        $post = Post::findOrFail($id);

        return view('post', [
            'post' => $post
        ]);
    }
}
