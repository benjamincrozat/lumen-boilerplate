<?php

namespace App\Repositories;

use Illuminate\Cache\CacheManager;

abstract class BaseCacheRepository
{
    /**
     * This variable has to be set in order to tag keys and values in the cache.
     *
     * @var string
     */
    public static $tag;

    /**
     * @var CacheManager
     */
    protected $cache;

    public function __construct()
    {
        $this->cache = app('cache');
    }

    /**
     * Generate a cache key from an array usually coming from Illuminate\Http\Request::all().
     */
    public static function keyFromData(array $data) : string
    {
        return md5(serialize($data));
    }

    /**
     * Wrapper around Illuminate\Cache\Repository::remember() to keep the code DRY.
     *
     * @return mixed
     */
    protected function remember(string $key, \Closure $callback, int $time = 60)
    {
        return $this->cache->tags(self::$tag)->remember($key, $time, $callback);
    }
}
