<?php
  ob_start();
  error_reporting(0);
  session_start();
  include_once("connectdb.php");
  include("tempadmin.php");

  $user = $_POST['user'];
  $user = mysqli_real_escape_string($con,$user);
  $user = strtolower($user);
  //$user = md5($user);
  $pass = $_POST['password'];
  $pass = mysqli_real_escape_string($con,$pass);
  $pass = md5($pass);
  $failed = "";

  $sql = "SELECT * FROM admins WHERE admin='$user' AND pass='$pass'";
  $records = mysqli_query($con,$sql);
  //$row = mysqli_fetch_array($records);

  $coun = mysqli_num_rows($records);

  if(isset($_POST['loginbtn'])){
    if($coun == 1){
      //session_register("user");
      $_SESSION['user'] = $_POST['user'];
      header("refresh:2; url=index.php");
      $failed = "Login Successfull! Please wait";

    } else{
      $failed = "Your credintials is not valid";
    }
  }

    ob_end_flush();
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="shortcut icon" href="logo.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/login.css" />
</head>
<body>
<div  id="login">
  <form action="login.php" method="POST">
    <p>
      <label>Username:</label>
      <input type='text' name='user' autofocus='true'>
    </p>
    <p>
      <label>Password:</label>
      <input type='password' name='password'>
    </p>
    <p>
      <!-- <input id="btn" name ="loginbtn" type="submit" value="Log in"> -->
      <button id="btn" name ="loginbtn">Log in</button>
    </p>
    <?php echo $failed; ?>
  </form>
</div>
</body>
</html>
