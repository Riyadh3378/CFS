<?php
error_reporting(0);
//$rf = $_SERVER["PHP_SELF"];
if(!isset($_COOKIE['language'])){
  //$default = ($_POST['lang']=='') ? 'en' : ($_POST['lang']);
  // setcookie('language','en');
  // $default = $_COOKIE['language'];
  $default = 'en';
  include ("language/$default.inc");
}else{
  $default = $_COOKIE['language'];
  include ("language/$default.inc");
  // echo $default;
  // $rf = $_SERVER["PHP_SELF"];
  // echo $rf;
  //header('location:"?"');
}

if(isset($_POST['lanbn'])){
    // $default = ($_POST['lang']=='') ? 'bn' : ($_POST['lang']);
    setcookie('language','bn');
    $default = $_COOKIE['language'];
    //header("refresh:1; url=$rf");
    header("location: ".$_SERVER['REQUEST_URI']);
    //header("location: ".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
    //header("Refresh:1");
  } elseif(isset($_POST['lanen'])){
    // $default = ($_POST['lang']=='') ? 'en' : ($_POST['lang']);
    setcookie('language','en');
    $default = $_COOKIE['language'];
    //header("location: ".$_SERVER['PHP_SELF']);
    header("location: ".$_SERVER['REQUEST_URI']);
    //header("location: ".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
    //header("Refresh:1");
  }

  $expiry = new DateTime('+1 day');
  //setcookie('language',$default);
 ?>
