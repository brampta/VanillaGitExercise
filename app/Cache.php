<?php

namespace VanillaGit;

class Cache {
    private $cache_location = __DIR__ . '/../cache';
    
    //save to cache
    //$key: name for cache element
    function save($key,$value){
        file_put_contents($this->cacheFileName($key),serialize($value));
    }
    //get from cache
    //$key: name for cache element
    function get($key){
        $cached_data=false;
        if($file_contents=file_get_contents($this->cacheFileName($key))){
            $cached_data['data']=unserialize($file_contents);
            $cached_data['mtime']=filemtime($this->cacheFileName($key));
        }
        
        return $cached_data;
    }
    function cacheFileName($key){
        return $this->cache_location.DIRECTORY_SEPARATOR.$key.'.cache';
    }
    
}