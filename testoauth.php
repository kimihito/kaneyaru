<?php
session_start();
require_once("twitteroauth.php"); //ライブラリの読み込み

//セッションにアクセストークンがなかったらログインページに移動
if($_SESSION['oauth_token'] === NULL && $_SESSION['oauth_token_secret']===NULL){
  header("Location: login.php");
}

$name = $_SESSION['name'];
$screen_name = $_SESSION['screen_name'];
echo "<html><head><title>top</title></head><body>";
echo "<p>ようこそ！" . $screen_name . "</p>";
echo "<p>" . $name . "</p>";
echo "<p><a href=\"./logout.php\">ログアウト</a></p>";
?>
