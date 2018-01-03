<?php

namespace App\Contracts;

use App\Post;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostsRepositoryContract
{
    public function list(array $data) : LengthAwarePaginator;

    public function store(array $data) : void;

    public function get(int $id) : Post;

    public function update(int $id, array $data) : Post;

    public function delete(int $id) : void;
}
