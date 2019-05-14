<?php

namespace App\Http\Controllers;

use App\Repository\PostSearchRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $postSearchRepository;

    public function __construct(PostSearchRepository $postSearchRepository)
    {
        $this->postSearchRepository = $postSearchRepository;
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = [];

        if ($query !== null) {
            $posts = $this->postSearchRepository->search($query);
        }

        return view('home', [
            'query' => $query,
            'posts' => $posts
        ]);
    }
}
