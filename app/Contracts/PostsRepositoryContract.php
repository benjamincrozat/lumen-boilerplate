<?php

namespace App\Contracts;

use App\Post;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * This interface is here to make sure each repository is on the same page.
 */
interface PostsRepositoryContract
{
    public function list(array $data) : LengthAwarePaginator;

    public function store(array $data) : void;

    public function get(int $id) : Post;

    public function update(int $id, array $data) : Post;

    public function delete(int $id) : void;
}
