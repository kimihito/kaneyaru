<?php
session_start();
require_once('twitteroauth.php');

$consumer_key = "5NQodaEga8MThaZs2xr2g";
$consumer_secret = "GXQiryxprtOXq7QQEQwDp45uhTMyZeCuCPl4c82g838";

//パラメータからoauth_twitterを取得
$verifier = $_GET['oauth_verifier'];

//OAuthオブジェクト生成
$to = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['request_token'], $_SESSION['request_token_secret']);

//oauth_verifierを使ってAccess tokenを取得
$access_token = $to->getAccessToken($verifier);

//token keyとtoken secret, user_id, screen_nameをセッションに保存
$_SESSION['oauth_token'] = $access_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $access_token['oauth_token_secret'];

//TwitterのID
$_SESSION['user_id'] = $access_token['user_id'];

//スクリーンネーム
$_SESSION['screen_name'] = $access_token['screen_name'];

header("Location: form.php");
?>

