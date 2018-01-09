<?php

namespace App\Repositories;

abstract class BaseCacheRepository
{
    /**
     * This variable has to be set in order to tag keys and values in the cache.
     *
     * @var string
     */
    public static $tag;

    /**
     * Generate a cache key from an array usually coming from Illuminate\Http\Request::all().
     *
     * @param array $data
     *
     * @return string
     */
    public static function keyFromData(array $data)
    {
        return md5(serialize($data));
    }

    /**
     * Wrapper around Illuminate\Cache\Repository::remember() to keep the code DRY.
     *
     * @param mixed    $key
     * @param \Closure $callback
     * @param int      $time
     *
     * @return mixed
     */
    protected function remember($key, \Closure $callback, $time = 60)
    {
        return app('cache')->tags(self::$tag)->remember($key, $time, $callback);
    }
}
