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
     * @var PostsRepository
     */
    protected $next;

    /**
     * Constructor.
     *
     * @param PostsRepository $repository
     */
    public function __construct(PostsRepository $repository)
    {
        parent::__construct();

        $this->next = $repository;
    }

    /**
     * Get posts from cache or database if it doesn't exist.
     *
     * @param array $data
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function list(array $data)
    {
        return $this->remember($this->keyFromData($data), function () use ($data) {
            return $this->next->list($data);
        });
    }

    /**
     * Store a post.
     *
     * @param array $data
     */
    public function store(array $data)
    {
        $this->next->store($data);
    }

    /**
     * Get a post from cache or database if it doesn't exist.
     *
     * @param mixed $id
     *
     * @return App\Post
     */
    public function get($id)
    {
        return $this->remember($id, function () use ($id) {
            return $this->next->get($id);
        });
    }

    /**
     * Remove a post from cache, update it and cache it again.
     *
     * @param mixed $id
     * @param array $data
     *
     * @return mixed
     */
    public function update($id, array $data)
    {
        // The resource has been updated, we no longer need the existing cache.
        $this->cache->tags(self::$tag)->forget($id);

        return $this->remember($id, function () use ($id, $data) {
            return $this->next->update($id, $data);
        });
    }

    /**
     * Delete a post from cache and database.
     *
     * @param mixed $id
     */
    public function delete($id)
    {
        // The resource has been removed, we can forget about it.
        $this->cache->tags(self::$tag)->forget($id);

        $this->next->delete($id);
    }
}
