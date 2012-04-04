<?php
require_once 'dbconf.php';
require_once('twitteroauth.php');
session_start();
 $con = mysql_connect(HOST, USERNAME, PASSWORD);

mysql_connect(HOST, USERNAME, PASSWORD) or die("Could not connect");
mysql_select_db (TABLE) or die('Cannot connect to the database because: ' . mysql_error());


 $result = mysql_query("SET NAMES utf8", $con);
   
   if(!$result){
      
   }

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_SESSION['screen_name'])){
    $name = cnv_dbstr($_SESSION['screen_name']);  //$_POST使わないといけない気がする;
    $money = cnv_dbstr($_POST["money"]);
    $want = cnv_dbstr($_POST["want"]);
    }else{
      echo "ユーザー名が入ってません";
    }
    
    if(!empty($money) && !empty($want)){
      $sql = "INSERT INTO " . TABLE . "  (name, money, want, date) VALUES ('$name', $money , '$want', now())";
      //echo $sql;
      mysql_query($sql);
      
      header("Location: http://localhost:8888/kaneyaru/index.php" ); 
    }
   
  // var_dump($sql);
    //var_dump($_SESSION['screen_name']);
    
}

 function cnv_dbstr($string) {
 
     $string = htmlspecialchars($string);
  
  if(get_magic_quotes_gpc()) {
     $string = stripslashes($string);
  }
  
  $string = mysql_real_escape_string($string);
  return $string;
}


?>
