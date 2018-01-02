<?php

namespace App\Repositories;

use App\Post;
use App\Contracts\RepositoryContract;

class PostsRepository implements RepositoryContract
{
    public function list(array $data)
    {
        return Post::with('user')->paginate(20);
    }

    public function store(array $data)
    {
        $user = app('auth')->user();

        return tap($user->posts()->save(new Post($data)))->setRelation('user', $user);
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
