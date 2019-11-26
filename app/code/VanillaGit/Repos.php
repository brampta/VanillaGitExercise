<?php

namespace VanillaGit;

class Repos{
    public function getRepos($user){
        $user_info=$user->show();
        $cache_class = new \VanillaGit\Cache();
        $cache_key=$user_info['login'].'_repos';
        $potential_cache=$cache_class->get($cache_key,5);
        if($potential_cache){
            $repositories=$potential_cache['data'];
            echo "got from cache..<br>";
        }else{
            $repositories = $user->repositories($user_info['login'],'owner','asc');
            $cache_class->save($cache_key,$repositories);
        }
        return $repositories;
    }
    public function getReposByOwner($user){
        $repositories = $this->getRepos($user);
        $owners=array();
        foreach($repositories as $key => $value){
            $owner = $value['owner'];
            unset($value['owner']);
            if(!isset($owners[$owner['id']])){
                $owners[$owner['id']]=$owner;
            }
            $owners[$owner['id']]['repos'][]=$value;
        }
        return $owners;
    }
}