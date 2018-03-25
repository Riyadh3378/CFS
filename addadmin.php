<!DOCTYPE html>
<?php
  error_reporting(0);
  include_once('connectdb.php');
  include('admincheck.php');
  include('menu.html');
  if(!isset($_SESSION)){
    session_start();
  }

  $user = $_SESSION["user"];
  $user = strtolower($user);
  $dateon = date('Y-m-d h:m:s');
  $tempmin = $_POST['temptime'].value;
  //$user = md5($user);
  $sql = "SELECT * FROM admins WHERE admin='$user'";
  $res = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($res);
  $privi = $row['privilege'];
  
  $dateTime = new DateTime();
  $dateTime->modify("+{$tempmin} minutes");
  $tempTimeDuration = $dateTime->format('Y-m-d H:i:s');
  //echo $dateTime->format('Y-m-d H:i:s');
  $msg = "";
  // echo $user;
  // echo $privi;

  //echo "Add admin";
  if($privi>0){

    $nadmin = $_POST['addadminname'];
    $nadmin = mysqli_real_escape_string($con,$nadmin);
    $nadmin = strtolower($nadmin);
    //$nadmin = md5($nadmin);
    $npass = $_POST['addpass'];
    $npass = mysqli_real_escape_string($con,$npass);
    $npass = md5($npass);

    if(isset($_POST['deladmin'])){
      echo "Delete";
    }
	
	if (isset($_POST['tempadminbtn'])){
		$qry = mysqli_query($con, "INSERT INTO admins (admin, pass, privilege, addedby, addedon, temporary)
                            VALUES ('$nadmin', '$npass', '$_POST[addprivi]', '$user', '$dateon', '$tempTimeDuration')");
            if($qry){
              $msg = "Temporary Admin added Successfully!";
              header("Refresh:2; url=index.php");
			}
	}
    if(isset($_POST['addadminbtn'])){
      $sql1 = mysqli_query($con, "SELECT * FROM admins WHERE admin='$nadmin'");
      $exi = mysqli_num_rows($sql1);
      if($exi > 0){
        $msg = "Admin '".$_POST['addadminname']."' is already exist!";
      } else {
        if($privi < $_POST['addprivi']){
          $msg = "Sorry, You cannot add an admin with higher privilege than yours!!!";
        } else {
          if($_POST['addpass']==$_POST['addrepass']){
            $qry = mysqli_query($con, "INSERT INTO admins (admin, pass, privilege, addedby, addedon)
                            VALUES ('$nadmin', '$npass', '$_POST[addprivi]', '$user', '$dateon')");
            if($qry){
              $msg = "Admin added Successfully!";
              header("Refresh:2; url=index.php");
            } else {
              //$msg = "Sorry! something went wrong";
			  $msg = mysql_error();
            }
        } else {
          $msg = "Passwords don't match";
        }
      }
    } 
  }

    ?><html>
      <head>
        <title><?php echo $lang['add_admin'] ?></title>
        <meta http-equiv="Content_Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/login.css" />
      </head>
      <body>
        <div  id="addbtndiv">
          <form action="deladmin.php" method="post">
          <?php
            if($privi>1){
              ?>
                <button id="addadminbtn" name ="deladminbtn"><?php echo $lang['delete_admin'] ?></button>
				
              <?php
            }
           ?>
		   
         </form>
          <form action="" method="POST">
            <p>
              <label><?php echo $lang['admin_name'] ?></label>
            </p><p>
              <input type='text' name='addadminname' required pattern="^[A-Za-z0-9]+"
                oninvalid="this.setCustomValidity('Please use (4-12 characters) from A-Z,a-z,0-9')"
                oninput="setCustomValidity('')" maxlength="12" minlength="4">
            </p>
            <p>
              <label><?php echo $lang['password'] ?></label>
            </p><p>
              <input type='password' name='addpass' required pattern="^[A-Za-z0-9@!%]+"
              oninvalid="this.setCustomValidity('Please use (6-20 characters) from A-Z,a-z,0-9,@,!,%')"
              oninput="setCustomValidity('')" maxlength="20" minlength="6">
            </p>
            <p>
              <label><?php echo $lang['re-password'] ?></label>
            </p><p>
              <input type='password' name='addrepass' required pattern="^[A-Za-z0-9@!%]+">
            </p>
            <p>
              <label><?php echo $lang['privilege'] ?></label>
            </p><p>
              <input type='addprivi' name='addprivi' required pattern="^[0-9]+"
              oninvalid="this.setCustomValidity('Please enter 0 or 1')" oninput="setCustomValidity('')">
            </p>
            <p>
              <!-- <input id="btn" name ="loginbtn" type="submit" value="Log in"> -->
              <button id="addadminbtn" name ="addadminbtn"><?php echo $lang['add_admin'] ?></button>
			  <input id="addadminbtn" style="background-color:white;color:black;" type="text" 
				name="temptime" placeholder="<?php echo $lang['temporary_time'] ?>">
				<button id="addadminbtn" name ="tempadminbtn"><?php echo $lang['temporary_admin'] ?></button>
            </p>
            <?php echo $msg; ?>
          </form>
        </div>
      </body>
    </html>
    <?php
  } elseif($privi<1) {
    $msg = "Sorry, you don't have the privilege to add new admin! ";
    echo $msg;
    echo '<a href="index.php">Home</a>';
  }

 ?>
