<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Collection;

interface PostSearchRepository
{
    public function search(string $query): Collection;
}
