<?php

namespace App\Repositories;

abstract class BaseCacheRepository
{
    /**
     * Cache tag.
     *
     * @var string
     */
    public static $tag;

    /**
     * @var mixed
     */
    protected $next;

    /**
     * Create a new cache repository instance.
     *
     * @param mixed $repository
     */
    public function __construct($repository)
    {
        $this->next = $repository;
    }

    /**
     * Wrapper around Illuminate\Cache\Repository::remember() to keep the code DRY.
     *
     * @param string   $key
     * @param \Closure $callback
     * @param int      $time
     *
     * @return mixed
     */
    protected function remember($key, \Closure $callback)
    {
        return $this->tagged()->rememberForever($key, $callback);
    }

    /**
     * Flush tagged items.
     */
    protected function flush()
    {
        $this->tagged()->flush();

        event('cache.tag_flushed', [self::$tag]);
    }

    /**
     * Return tagged cache.
     *
     * @return \Illuminate\Cache\TaggedCache
     */
    protected function tagged()
    {
        return app('cache')->tags(self::$tag);
    }
}
