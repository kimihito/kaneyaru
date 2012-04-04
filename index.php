<?php 
    require_once 'dbconf.php';
    require_once 'function.php';
    session_start();
    print_r($_SESSION);
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

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>金やる</title>
        <link href="http://localhost:8888/twitteroauth/common.css" media="screen" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="all">
            <p><a href="oauthtweet.php">Sign in with Twitter</a></p>
            <h1><a href="index.php">金やる</a></h1>
            <p>金やるはインターネットの投げ銭サイトです</p>
            <h2><a href="oauthtweet.php">Twitter アカウントでログインしてお金を投げる</a></h2>
            <table>
                <tr>
                    <th>Twitter</th>
                    <th>あげたい金額</th>
                    <th>こんな人にあげたい</th>
                    <th>この人にたかる</th>
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
