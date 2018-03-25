<?php
  $logged = false;
  include_once("connectdb.php");
  session_start();
  if($_SESSION['user']){
    //$nam = $_POST['user'];
    $logged = true;
  } else {
    $logged = false;
  }
 ?>
