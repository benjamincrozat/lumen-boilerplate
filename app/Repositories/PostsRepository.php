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
     *
     * @return Paginator
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
        if (! ($post = $this->user->posts()->save(new Post($data)))) {
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
     * @return bool
     */
    public function destroy($id)
    {
        return Post::findOrFail($id)->delete();
    }
}
