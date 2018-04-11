<?php

namespace App\Repositories;

use App\Post;
use App\Contracts\PostsRepositoryContract;

class PostsCacheRepository extends BaseCacheRepository implements PostsRepositoryContract
{
    /**
     * Cache tag.
     *
     * @var string
     */
    public static $tag = Post::class;

    /**
     * Get posts.
     *
     * @param array $data
     *
     * @return Paginator
     */
    public function index(array $data)
    {
        return $this->remember(md5(serialize($data)), function () use ($data) {
            return $this->next->index($data);
        });
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
        $this->flush();

        return $this->next->store($data);
    }

    /**
     * Get a post.
     *
     * @param string $id
     *
     * @return Post
     */
    public function show($id)
    {
        return $this->remember($id, function () use ($id) {
            return $this->next->show($id);
        });
    }

    /**
     * Update a post.
     *
     * @param string $id
     * @param array  $data
     *
     * @return Post
     */
    public function update($id, array $data)
    {
        $this->flush();

        return $this->remember($id, function () use ($id, $data) {
            return $this->next->update($id, $data);
        });
    }

    /**
     * Delete a post.
     *
     * @param string $id
     */
    public function destroy($id)
    {
        $this->flush();

        $this->next->destroy($id);
    }
}
