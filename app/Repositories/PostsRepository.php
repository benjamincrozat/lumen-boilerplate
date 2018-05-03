<?php

namespace App\Repositories;

use App\Post;
use Exception;
use App\Contracts\PostsRepositoryContract;

class PostsRepository implements PostsRepositoryContract
{
    /**
     * {@inheritdoc}
     */
    public function index(array $data)
    {
        return Post::latest()->paginate(20);
    }

    /**
     * {@inheritdoc}
     */
    public function store(array $data)
    {
        if (! ($post = app('auth')->user()->posts()->save(new Post($data)))) {
            abort('Error while creating the resource.');
        }

        return $post;
    }

    /**
     * {@inheritdoc}
     */
    public function show($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     *
     * @throws Exception
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
    }
}
