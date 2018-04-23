<?php

namespace App\Repositories;

use App\Post;
use App\Contracts\PostsRepositoryContract;

class PostsRepository implements PostsRepositoryContract
{
    /**
     * Get posts.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function index(array $data)
    {
        return Post::latest()->paginate(20);
    }

    /**
     * Store a post.
     *
     * @param array $data
     *
     * @return Post
     */
    public function store(array $data)
    {
        if (! ($post = app('auth')->user()->posts()->save(new Post($data)))) {
            abort('Error while creating the resource.');
        }

        return $post;
    }

    /**
     * Get a post.
     *
     * @param string|int $id
     *
     * @return Post
     */
    public function show($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * Update a post.
     *
     * @param string|int $id
     * @param array      $data
     *
     * @return Post
     */
    public function update($id, array $data)
    {
        $post = Post::findOrFail($id);

        if (! $post->update($data)) {
            abort('Error while updating the resource.');
        }

        return $post;
    }

    /**
     * Delete a post.
     *
     * @param string|int $id
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
    }
}
