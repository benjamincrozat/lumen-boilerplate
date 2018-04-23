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
    protected function remember($key, \Closure $callback, $time = 60)
    {
        return $this->tagged()->remember($key, $time, $callback);
    }

    /**
     * Flush tagged items.
     */
    protected function flush()
    {
        $this->tagged()->flush();
    }

    /**
     * Return tagged cache.
     *
     * @return \Illuminate\Cache\TaggedCache
     */
    protected function tagged()
    {
        return app('cache')->tags([
            self::$tag,
            optional(app('auth')->user())->id,
        ]);
    }
}
