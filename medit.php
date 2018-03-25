<!DOCTYPE html>

<?php
  error_reporting(0);
  include_once("connectdb.php");
  include("menu.html");

  $m_id = $_GET['id'];
  // echo $m_id;
  $sql = "SELECT * FROM members WHERE id=$m_id";
  $records = mysqli_query($con, $sql) or die('error');
  $mdata = mysqli_fetch_array($records);
 ?>

 <!-- required fields -->
  <?php
  	$n = $lang['m_name'];
	$no = $lang['m_no'];
	$f = $lang['mf_name'];
	$m = $lang['mm_name'];
	$r = $lang['m_religion'];
	$g = $lang['m_gen'];
	$s = $lang['m_school'];
	$c = $lang['m_college'];
	$v = $lang['m_varsity'];
	$job = $lang['m_job'];
	$a = $lang['m_address'];
	$mo = $lang['m_mobile'];
	$e = $lang['m_email'];
	$d = $lang['m_dob'];
	$j = $lang['m_join'];
	$b = $lang['m_bg'];
  ?>

  <!-- values from database -->
   <?php
   	$dn = $mdata['m_name'];
   	$dno = $mdata['member_no'];
   	$df = $mdata['mf_name'];
   	$dm = $mdata['mm_name'];
    $dr = $mdata['m_religion'];
    $dg = $mdata['m_gen'];
   	$ds = $mdata['m_school'];
   	$da = $mdata['m_address'];
   	$dmo = $mdata['m_mobile'];
   	$de = $mdata['m_email'];
   	$dd = $mdata['m_dob'];
   	$dj = $mdata['m_join'];
   	$db = $mdata['m_bg'];
    $dimg = $mdata['m_img'];
   ?>

 <?php
 ini_set('mysql.connect_timeout', 300);
 ini_set('default_socket_timeout',300);


   if($_POST['post_memberno'] == ''){
     $_POST['post_memberno'] = $dno;
   }
   if($_POST['post_uname'] == ''){
     $_POST['post_uname'] = $dn;
   }
   if($_POST['post_ufname'] == ''){
     $_POST['post_ufname'] = $df;
   }
   if($_POST['post_umname'] == ''){
     $_POST['post_umname'] = $dm;
   }
   if($_POST['post_ureli'] == ''){
     $_POST['post_ureli'] = $dr;
   }
   if($_POST['post_ugen'] == ''){
     $_POST['post_ugen'] = $dg;
   }
   if($_POST['post_uschool'] == ''){
     $_POST['post_uschool'] = $ds;
   }
   if($_POST['post_uaddress'] == ''){
     $_POST['post_uaddress'] = $da;
   }
   if($_POST['post_umobile'] == ''){
     $_POST['post_umobile'] = $dmo;
   }
   if($_POST['post_uemail'] == ''){
     $_POST['post_uemail'] = $de;
   }
   if($_POST['post_ubg'] == ''){
     $_POST['post_ubg'] = $db;
   }
   if($_POST['post_udob'] == ''){
     $_POST['post_udob'] = $dd;
   }
   if($_POST['post_ujoin'] == ''){
     $_POST['post_ujoin'] = $dj;
   }

   if(isset($_POST['update'])){
       $qry = "UPDATE member SET member_no = '$_POST[post_memberno]',
                                 m_name    = '$_POST[post_uname]',
                                 mf_name   = '$_POST[post_ufname]',
                                 mm_name   = '$_POST[post_umname]',
                                 m_religion  = '$_POST[post_ureli]',
                                 m_gen   = '$_POST[post_ugen]',
                                 m_school  = '$_POST[post_uschool]',
                                 m_address = '$_POST[post_uaddress]',
                                 m_mobile  = '$_POST[post_umobile]',
                                 m_email   = '$_POST[post_uemail]',
                                 m_bg      = '$_POST[post_ubg]',
                                 m_dob     = '$_POST[post_udob]',
                                 m_join    = '$_POST[post_ujoin]'
                             WHERE id = $m_id";

       $update = mysqli_query($con, $qry) or die(errora);
        if($update){
          //echo "<h1><br /> Member's details updated Successfully!!</h1>";
     		  $filename = $_FILES['image']['name'];
     			$file_type = $_FILES['image']['type'];
     			$ext = pathinfo($filename, PATHINFO_EXTENSION);
     			$target = "mimages/".basename("$m_id."."$ext");
     			header('Refresh:2, url=showmembers.php');
     			if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
     				//$msg = "Image uploaded Successfully";
     			} else {
   				//$msg = "Something went wrong";
   			  }
         //header("Refresh: 2; url=showmembers.php");
       } else {
         echo "<h2><br /> Error!!</h2>";
       }
   }
 ?>


 <html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <meta http-equiv="Content_Type" content="text/html; charset=utf-8"/>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script language="javascript" type="text/javascript" src="script/preview.js"></script>
   <link rel="shortcut icon" href="logo.png" type="image/x-icon"/>
   <title><?php echo $lang[$default]['add_member']?></title>
   <link rel="stylesheet" type="text/css" href="css/main.css" />
 </head>
 <body>
   <div>
 		<p align="center"><br/><br/>
 				<br/><br/></p>
 	</div>
  <?php
    foreach (new DirectoryIterator(__DIR__.'/mimages') as $file) {
      if ($file->isFile()) {
          $path = pathinfo($file);
          $imgname = $path['filename'];
          if($imgname == $mdata['id']){
            $imgext = $path['extension'];
          }
      }
    }
   ?>
 	<form class = "form-horizontal" action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 		<table id ="newUser" align="center">
 			<tr>
 				<td><?php echo $n.'*	' ?></td>
 				<td><input type="text" name="post_uname" required pattern="^[A-Za-z:._-/()]+" value="<?php echo $dn ?>"><br/></td>
        <td><?php echo $lang[$default]['m_img'] ?>
            <input type="file" onchange="showImage.call(this)" name="image"></td>
          <br/>
 			</tr>
 			<tr>
 				<td><?php echo $no ?></td>
 				<td><input type="text" name="post_memberno" required pattern="^[0-9]+" value="<?php echo $dno ?>"><br/></td>
        <td rowspan="6"><div><img id="preview" height="200" width ="200" src="mimages/<?php echo $mdata['id'].'.'.$imgext ?>"></div>
 		    </td>
      </tr>
 			<tr>
 				<td><?php echo $f ?></td>
 				<td><input type="text" name="post_ufname" pattern="^[A-Za-z:._-/()]+" value="<?php echo $df ?>"><br/></td>
 			</tr>
 			<tr>
 				<td><?php echo $m ?></td>
 				<td><input type="text" name="post_umname" pattern="^[A-Za-z:._-/()]+" value="<?php echo $dm ?>"><br/></td>
 			</tr>
      <tr>
 				<td><?php echo $r ?></td>
 				<td><input type="text" name="post_ureli" pattern="^[A-Za-z:._-/()]+" value="<?php echo $dr ?>"><br/></td>
 			</tr>
 			<tr>
 				<td><?php echo $g ?></td>
 				<td>
          <?php
            if($dg=="Male"){
              ?>
              <input type="radio" name="post_ugen" value="Male" checked>Male
     					<input type="radio" name="post_ugen" value="Female">Female<br/>
              <?php
            } else {
              ?>
              <input type="radio" name="post_ugen" value="Male" >Male
     					<input type="radio" name="post_ugen" value="Female" checked>Female<br/>
              <?php
            }
          ?>
        </td>
 			</tr>
 			<tr>
 				<td><?php echo $s ?></td>
 				<td><input type="text" name="post_uschool" value="<?php echo $ds ?>"><br/></td>
 			</tr>
 			<tr>
 				<td><?php echo $a ?></td>
 				<td><input type="text" name="post_uaddress" value="<?php echo $da ?>"><br/></td>
 			</tr>
 			<tr>
 				<td><?php echo $mo ?></td>
 				<td><input type="text" name="post_umobile" pattern="^[0-9+-]+" value="<?php echo $dmo ?>"><br/></td>
        <td><button id = "sub" name="update">Update</button></td>
      </tr>
 			<tr>
 				<td><?php echo $b ?></td>
 				<td><select id="mbgs" name="post_ubg">
 					 <option value="<?php echo $db;?>"><?php echo $db;?></<option>
 					 <option value="A+">A+</option>
 					 <option value="A-">A-</option>
 					 <option value="B+">B+</option>
 					 <option value="B-">B-</option>
 					 <option value="AB+">AB+</option>
 					 <option value="AB-">AB-</option>
 					 <option value="O+">O+</option>
 					 <option value="O-">O-</option>
 				</select><br/></td>
 			</tr>
 			<tr>
 				<td><?php echo $e ?></td>
 				<td><input type="text" name="post_uemail" value="<?php echo $e ?>"><br/></td>
 			</tr>
 			<tr>
 				<td><?php echo $d ?></td>
 				<td><input type="date" value="<?php echo $dd; ?>"
 							name="post_udob" ><br/></td>
 			</tr>
 			<tr>
 				<td><?php echo $j ?></td>
 				<td><input type="date" value="<?php echo $dj; ?>"
 							name="post_ujoin" ><br/></td>
 			</tr>
 		<br/><br/>

 </form>
 </body>
 </html>
