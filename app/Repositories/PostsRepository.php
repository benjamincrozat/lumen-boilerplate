<?php

namespace App\Repositories;

use App\Post;
use App\Contracts\RepositoryContract;

class PostsRepository implements RepositoryContract
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
        return tap($this->user->posts()->save(new Post($data)))
            ->setRelation('user', $this->user);
    }

    public function get($key)
    {
        return Post::with('user')->findOrFail($key);
    }

    public function update($key, array $data)
    {
        return tap(Post::with('user')->findOrFail($key))->update($data);
    }

    public function delete($key)
    {
        return Post::findOrFail($key)->delete();
    }
}
