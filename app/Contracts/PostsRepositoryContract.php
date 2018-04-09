<?php

namespace App\Contracts;

/**
 * This interface is here to make sure each repository is on the same page.
 */
interface PostsRepositoryContract
{
    /**
     * Get posts.
     *
     * @param array $data
     *
     * @return Paginator
     */
    public function index(array $data);

    /**
     * Store a post.
     *
     * @param array $data
     *
     * @return Post
     */
    public function store(array $data);

    /**
     * Get a post.
     *
     * @param string $id
     *
     * @return Post
     */
    public function show($id);

    /**
     * Update a post.
     *
     * @param string $id
     * @param array  $data
     *
     * @return Post
     */
    public function update($id, array $data);

    /**
     * Delete a post.
     *
     * @param string $id
     */
    public function destroy($id);
}
