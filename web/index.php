<?php
//temp... for dev...
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();

require __DIR__ . '/../app/bootstrap.php';


//just ifs cuz no time to create proper controller mechanism... to be improved.. in another life..

//this is the login/logout controller
if(isset($_GET['oauth'])){
    $oauth = new \VanillaGit\OAuth();
    $token = $oauth->getToken();
    //var_dump($token);
    $_SESSION['oauth_token'] = $token;
    header('Location: ?');
}else if(isset($_GET['oauthlogout'])){
    unset($_SESSION['oauth_token']);
}

if(isset($_SESSION['oauth_token'])){
    //this is if you have a token in session, lets try to work with it
    $github_api_client = new \Github\Client();
    $user_class = new \VanillaGit\User($github_api_client);
    //we try to log you in with your token
    $user_class->oauth($_SESSION['oauth_token']);
    $user = $user_class->get();
    if($user){
        //if we were able to read the user info, then youre correctly logged in
        $view_class = new \VanillaGit\View();
        $view_class->show('oauth_logout.phtml');
        $repo_class = new \VanillaGit\Repos();
        $repos_by_owner = $repo_class->getReposByOwner($user);
        $view_class->show('repos_by_owner_list.phtml',$repos_by_owner);
        
    }else{
        //if the token didnt work, redirect to the homepage so you can login
        unset($_SESSION['oauth_token']);
        header('Location: ?');
    }
}else{
    //if you did not have a token in session, heres the login link to obtain it
    $view_class = new \VanillaGit\View();
    $view_class->show('oauth_link.phtml');
}