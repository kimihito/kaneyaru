<?php 
session_start();
require_once("twitteroauth.php");

//Consumer keyの値
$consumer_key = "5NQodaEga8MThaZs2xr2g";
//Consumer secretの値
$consumer_secret = "GXQiryxprtOXq7QQEQwDp45uhTMyZeCuCPl4c82g838";

//OAuthオブジェクト生成
$to = new TwitterOAuth($consumer_key, $consumer_secret);
// callbackURLを指定してRequest tokenを取得
$tok = $to->getRequestToken("http://localhost:8888/kaneyaru/callback.php");
// セッションに保存
$_SESSION['request_token'] = $token = $tok['oauth_token'];
$_SESSION['request_token_secret'] = $tok['oauth_token_secret'];

//AuthorizeURLを取得
$url = $to->getAuthorizeURL($token);

echo"<html><head></head><body><a href=\"" .$url."\">ログイン</a></body></html>";

?>
