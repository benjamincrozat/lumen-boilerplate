<?php

namespace App\Repositories;

use App\Cache\Events\CacheFlushed;

abstract class BaseCacheRepository
{
    /**
     * Cache tag.
     *
     * @var string
     */
    protected $tag;

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
     * @param string|array $key
     *
     * @return bool
     */
    public function has($key)
    {
        return $this->tagged()->has($this->key($key));
    }

    /**
     * @param string   $key
     * @param \Closure $callback
     * @param int      $time
     *
     * @return mixed
     */
    protected function remember($key, \Closure $callback, $time = 60)
    {
        return $this->tagged()->remember($this->key($key), $time, $callback);
    }

    /**
     * Flush the cache only for the current tag.
     */
    protected function flush()
    {
        $this->tagged()->flush();

        event(new CacheFlushed('', $this->tags()));
    }

    /**
     * Return tagged cache.
     *
     * @return \Illuminate\Cache\TaggedCache
     */
    protected function tagged()
    {
        return app('cache')->tags($this->tags());
    }

    /**
     * Return an array of tags.
     *
     * @return array
     *
     * @throws \Exception
     */
    protected function tags()
    {
        // $this->tag cannot be null, 0, '', [], etc.
        if (empty($this->tag)) {
            throw new \Exception('The "tag" property of "' . get_class($this) . '" should have a value.');
        }

        $user_id = optional(app('auth')->user())->id;

        return [
            $this->tag,
            $user_id ?? 'guests',
        ];
    }

    /**
     * Normalize a given key.
     *
     * @param string|array $key
     *
     * @return string
     */
    protected function key($key)
    {
        if (is_array($key)) {
            $key = md5(serialize($key));
        }

        return $key;
    }
}
