<?php
  error_reporting();
  include_once('connectdb.php');
  //include('admincheck.php');
  if(!isset($_SESSION)){
    session_start();
  }
  $sql = "SELECT * FROM admins WHERE temporary < DATE_SUB(NOW(), INTERVAL 1 MINUTE)";
  $res = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($res);
  echo $row['id'];
  $qry = mysqli_query($con, "DELETE FROM admins WHERE temporary < DATE_SUB(NOW(), INTERVAL 1 MINUTE)");
?>