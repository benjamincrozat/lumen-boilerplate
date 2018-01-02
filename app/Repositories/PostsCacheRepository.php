<?php

namespace App\Repositories;

use App\Contracts\RepositoryContract;

class PostsCacheRepository extends BaseCacheRepository implements RepositoryContract
{
    public static $tag = Post::class;

    /**
     * @var PostsRepository
     */
    protected $next;

    public function __construct(PostsRepository $repository)
    {
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
        return $this->next->store($data);
    }

    public function get($key)
    {
        return $this->remember($key, function () use ($key) {
            return $this->next->get($key);
        });
    }

    public function update($key, array $data)
    {
        app('cache')->tags(self::$tag)->forget($key);

        return $this->remember($key, function () use ($key, $data) {
            return $this->next->update($key, $data);
        });
    }

    public function delete($key)
    {
        app('cache')->tags(self::$tag)->forget($key);

        return $this->next->delete($key);
    }
}
