<?php

namespace App\Repositories;

use App\Post;
use App\Contracts\PostsRepositoryContract;

class PostsRepository implements PostsRepositoryContract
{
    /**
     * @var App\User
     */
    protected $user;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->user = app('auth')->user();
    }

    /**
     * Get posts.
     *
     * @param array $data
     */
    public function list(array $data)
    {
        return Post::with('user')->paginate(20);
    }

    /**
     * Store a post.
     *
     * @param array $data
     */
    public function store(array $data)
    {
        if (! $this->user->posts()->save(new Post($data))) {
            abort('Error while creating the resource.');
        }
    }

    /**
     * Get a post.
     *
     * @param mixed $id
     */
    public function get($id)
    {
        return Post::with('user')->findOrFail($id);
    }

    /**
     * Update a post.
     *
     * @param mixed $id
     * @param array $data
     */
    public function update($id, array $data)
    {
        $post = Post::with('user')->findOrFail($id);

        if (! $post->update($data)) {
            abort('Error while updating the resource.');
        }

        return $post;
    }

    /**
     * Delete a post.
     *
     * @param mixed $id
     */
    public function delete($id)
    {
        if (! Post::findOrFail($id)->delete()) {
            abort('Error while deleting the resource.');
        }
    }
}
