<?php
require_once ("twitteroauth.php");
session_start();

//セッションにアクセストークンがなかったらloginページに移動
if($_SESSION['oauth_token'] == NULL || $_SESSION['oauth_token_secret'] == NULL){
    $consumer_key = "5NQodaEga8MThaZs2xr2g";
    
    $consumer_secret = "GXQiryxprtOXq7QQEQwDp45uhTMyZeCuCPl4c82g838";
    
    $twitter_oauth = new TwitterOAuth($consumer_key, $consumer_secret);
    
    //callbackURLを指定してRequest tokenを取得
    $request_token = $twitter_oauth->getRequestToken("http://localhost:8888/twitteroauth/callback.php");
    
    //セッションに保存
    $_SESSION['request_token'] = $token = $request_token['oauth_token'];
    $_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
    
    //サインインするためのURLを取得
    $url = $twitter_oauth->getAuthorizeURL($token);
    echo 'サインイン';
} else {
    //サインインしていればコンテンツを表示
    include ('form.php');
} 
?>
