<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
$client = new \Github\Client();
include("../app/User.php");
$user_class = new \VanillaGit\User($client);
include("../app/View.php");
$view_class = new \VanillaGit\View();

$user = $user_class->get();
if(isset($_POST['username']) && isset($_POST['password'])){
    $user_class->authenticate($_POST['username'],$_POST['password']);
    $user = $user_class->get();
    if($user){
        echo 'successfully logged in<br>';
    }else{
        echo 'login invalid<br>';
    }
}


if($user){
    //user logged in show repos
    $user_info=$user->show();
    include("../app/Cache.php");
    $cache_class = new \VanillaGit\Cache();
    $cache_key=$user_info['login'].'_repos';
    $potential_cache=$cache_class->get($cache_key);
    if($potential_cache && $potential_cache['mtime']>(time()-15)){
        $repositories=$potential_cache['data'];
        echo "got from cache..<br>";
    }else{
        $repositories = $user->repositories($user_info['login'],'owner','asc');
        $cache_class->save($cache_key,$repositories);
    }
    $view_class->show('repos_list.phtml',$repositories);
}else{
    //user not logged in show login form
    $view_class->show('login_form.phtml');
}