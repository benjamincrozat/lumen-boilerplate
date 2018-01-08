<?php

namespace App\Repositories;

use App\Post;
use App\Contracts\PostsRepositoryContract;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function list(array $data) : LengthAwarePaginator
    {
        return Post::with('user')->paginate(20);
    }

    public function store(array $data) : void
    {
        if (! $this->user->posts()->save(new Post($data))) {
            abort('Error while creating the resource.');
        }
    }

    public function get(string $id) : Post
    {
        return Post::with('user')->findOrFail($id);
    }

    public function update(string $id, array $data) : Post
    {
        $post = Post::with('user')->findOrFail($id);

        if (! $post->update($data)) {
            abort('Error while updating the resource.');
        }

        return $post;
    }

    public function delete(string $id) : void
    {
        if (! Post::findOrFail($id)->delete()) {
            abort('Error while deleting the resource.');
        }
    }
}
