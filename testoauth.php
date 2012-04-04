<?php
session_start();
require_once("twitteroauth.php"); //ライブラリの読み込み

//セッションにアクセストークンがなかったらログインページに移動
if($_SESSION['oauth_token'] === NULL && $_SESSION['oauth_token_secret']===NULL){
  header("Location: login.php");
}

$user_id = $_SESSION['user_id'];
$screen_name = $_SESSION['screen_name'];
echo "<html><head><title>top</title></head><body>";
echo "<p>ようこそ！" . $screen_name . "</p>";
echo "<p>" . $user_id . "</p>";
echo "<p><a href=\"./logout.php\">ログアウト</a></p>";
?>
