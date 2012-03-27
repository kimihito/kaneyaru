<?php 
    require_once 'function.php';
    session_start();
    print_r ($_SESSION);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>金やる</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="http://localhost:8888/twitteroauth/common.css" media="screen" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="all">
            <h1><a href="index.php">金やる</a></h1>
          　<p>Welcome to Kaneyaru</p>
              <h2>やる金情報登録</h2>
              <?php  echo $_SESSION['oauth_state']; ?>
              <form accept-charset="UTF-8" action="write.php" method="post"><div style="margin:0;padding: 0;display: inline">
                     <div id="user">
                       <?php 
                      echo '<img src="http://img.tweetimag.es/i/'  . $_SESSION['screen_name'] . '_b">'; 
                     echo $_SESSION['name']; ?><br>
                      </div>
                      
                      <input name="utf8" type="hidden" value=";" /><input name="autenticity_token" type="hidden" value=";" /></div>
                      <input id="name" name="name" type="hidden" value="<?php $_SESSION['screen_name']; ?>">
                  <p>
                      <b>提供金額</b>
                      <br>
                      <input id="money" name="money" size="50" type="text" />
                  </p>
                  <p>
                      <b>お金をあげたい人</b>
                      <br>
                      <textarea cols="80" id="want" name="want" rows="15"></textarea>
                  </p>
                  <p><input name="commit" type="submit" value="送信" /></p>
              </form>
           </div>
    </body>
</html>

