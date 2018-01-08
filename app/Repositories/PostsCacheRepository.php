<?php

namespace App\Repositories;

use App\Post;
use App\Contracts\PostsRepositoryContract;

class PostsCacheRepository extends BaseCacheRepository implements PostsRepositoryContract
{
    public static $tag = Post::class;

    /**
     * @var PostsRepository
     */
    protected $next;

    public function __construct(PostsRepository $repository)
    {
        parent::__construct();

        $this->next = $repository;
    }

    public function list(array $data)
    {
        return $this->remember($this->keyFromData($data), function () use ($data) {
            return $this->next->list($data);
        });
    }

    public function store(array $data)
    {
        $this->next->store($data);
    }

    public function get($id)
    {
        return $this->remember($id, function () use ($id) {
            return $this->next->get($id);
        });
    }

    public function update($id, array $data)
    {
        // The resource has been updated, we no longer need the existing cache.
        $this->cache->tags(self::$tag)->forget($id);

        return $this->remember($id, function () use ($id, $data) {
            return $this->next->update($id, $data);
        });
    }

    public function delete($id)
    {
        // The resource has been removed, we can forget about it.
        $this->cache->tags(self::$tag)->forget($id);

        $this->next->delete($id);
    }
}
