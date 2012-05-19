<?php 
  session_start();
  require_once('twitteroauth.php');
  require_once 'dbconf.php';

  //  //Consumer keyの値   
  $consumer_key = "5NQodaEga8MThaZs2xr2g";
  //Consumer secretの値
  $consumer_secret = "GXQiryxprtOXq7QQEQwDp45uhTMyZeCuCPl4c82g838";
  //OAuthオブジェクト生成
  $to = new TwitterOAuth($consumer_key, $consumer_secret);
  // callbackURLを指定してRequest tokenを取得
  $tok = $to->getRequestToken("http://kaneyaru.geeoki.com/callback.php");
  // セッションに保存
  $_SESSION['request_token'] = $token = $tok['oauth_token'];
  $_SESSION['request_token_secret'] = $tok['oauth_token_secret'];
  //AuthorizeURLを取得
  $url = $to->getAuthorizeURL($token);


  $con = mysql_connect(HOST, USERNAME, PASSWORD);

  if(!$con){
    exit('データベースに接続できませんでした');
  }

  $result = mysql_select_db (TABLE, $con);

  if(!$result){
    exit('データベースを選択できませんでした');
  }

  $result = mysql_query("SET NAMES utf8", $con);

  if(!$result){
    exit('文字コードを指定できませんでした');
  }

  $result = mysql_query("SELECT * FROM `". TABLE ."` ORDER BY date DESC", $con);

  if(!$result){
    die(mysql_error());
  }
  //  //Consumer keyの値   
  //  $consumer_key = "5NQodaEga8MThaZs2xr2g";
  //  //Consumer secretの値
  //  $consumer_secret = "GXQiryxprtOXq7QQEQwDp45uhTMyZeCuCPl4c82g838";
  //  //OAuthオブジェクト生成
  //  $to = new TwitterOAuth($consumer_key, $consumer_secret);
  //  // callbackURLを指定してRequest tokenを取得
  //  $tok = $to->getRequestToken("http://localhost:8888/kaneyaru/callback.php");
  //  // セッションに保存
  //  $_SESSION['request_token'] = $token = $tok['oauth_token'];
  //  $_SESSION['request_token_secret'] = $tok['oauth_token_secret'];
  //  //AuthorizeURLを取得
  //  $url = $to->getAuthorizeURL($token);
  //
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>金やる</title>
<link href="./common.css" media="screen" rel="stylesheet" type="text/css">
</head>
<body>
<div id="all">
      <p><a href="<?php echo $url;?>">Sign in with Twitter</a></p>
        <h1><a href="index.php">金やる</a></h1>
        <p>金やるはインターネットの投げ銭サイトです</p>
      <h2><a href="<?php echo $url; ?>">Twitter アカウントでログインしてお金を投げる</a></h2>
        <table>
        <tr>
        <th>Twitter</th>
        <th>あげたい金額</th>
        <th>こんな人にあげたい</th>
        </tr>
        <?php
          while($data = mysql_fetch_array($result)): 
        ?>
        <tr>
      <th> <?php print '<a href="http://twitter.com/#!/' . htmlspecialchars($data['name']) . '  "target="_blank"><img src="http://img.tweetimag.es/i/'  . htmlspecialchars($data['name']) . '_b"></a>' ?>
        </th>
      <th>￥<?php print(htmlspecialchars($data['money'])); ?></th>
      <th><?php print(htmlspecialchars($data['want'])); ?></th>
        <th></th>
        </tr>
        <?php
          endwhile;
          $con = mysql_close($con);
          if(!$con){
            exit('データベースとの接続を閉じられませんでした。');
          }
        ?>
        </table>
        </div>

        </body>
        </html>
