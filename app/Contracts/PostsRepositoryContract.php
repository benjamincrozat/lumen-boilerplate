<?php

namespace App\Contracts;

/**
 * This interface is here to make sure each repository is on the same page.
 */
interface PostsRepositoryContract
{
    public function list(array $data);

    public function store(array $data);

    public function get($id);

    public function update($id, array $data);

    public function delete($id);
}
