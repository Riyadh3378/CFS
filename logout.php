<?php
  if(!isset($_SESSION)){
    session_start();
  }
    $user = $_SESSION['user'];
    if($user){
      session_destroy();
      header("refresh:2; url=index.php");
      //echo "logged out";
    } else {
      echo "Something went wrong";
      header("refresh:4; url=index.php");
    }
 ?>
