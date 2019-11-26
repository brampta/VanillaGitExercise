<?php
namespace VanillaGit;

class Cache
{

    private $cache_location = BP . '/cache';

    // save to cache
    // $key: name for cache element
    function save($key, $value)
    {
        file_put_contents($this->cacheFileName($key), serialize($value));
    }

    // get from cache
    // $key: name for cache element
    function get($key, $max_oldness = 500)
    {
        $cached_data = false;
        $cache_age = filemtime($this->cacheFileName($key));
        if ($cache_age > (time() - $max_oldness)) {
            $file_contents = file_get_contents($this->cacheFileName($key));
        }

        return $cached_data;
    }

    function cacheFileName($key)
    {
        return $this->cache_location . DIRECTORY_SEPARATOR . $key . '.cache';
    }
}