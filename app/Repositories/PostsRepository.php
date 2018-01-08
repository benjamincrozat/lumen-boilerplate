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

    public function __construct()
    {
        $this->user = app('auth')->user();
    }

    public function list(array $data)
    {
        return Post::with('user')->paginate(20);
    }

    public function store(array $data)
    {
        if (! $this->user->posts()->save(new Post($data))) {
            abort('Error while creating the resource.');
        }
    }

    public function get($id)
    {
        return Post::with('user')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $post = Post::with('user')->findOrFail($id);

        if (! $post->update($data)) {
            abort('Error while updating the resource.');
        }

        return $post;
    }

    public function delete($id)
    {
        if (! Post::findOrFail($id)->delete()) {
            abort('Error while deleting the resource.');
        }
    }
}
