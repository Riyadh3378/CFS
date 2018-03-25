<?php
	error_reporting();
	$message = '';
	ini_set('mysql.connect_timeout', 300);
	ini_set('default_socket_timeout',300);
	include("admincheck.php");

	$full_address = $_POST[distSelected];
	$full_address .= " | ";
	$full_address .= $_POST[unionSelected];

	if(isset($_POST['addm']))
	{
		$sql0 = "SELECT * FROM members WHERE no='$_POST[post_no]'";
		$res0 = mysqli_query($con,$sql0);
		$count = mysqli_num_rows($res0);

		if($count == 0){
			$qry = "INSERT INTO members (no, name, father, mother, sex,
																religion, dob, blood,
																address, school, college,
																varsity, job, mobile,
																email, joined)
			VALUES ('$_POST[post_no]','$_POST[post_name]','$_POST[post_father]',
				'$_POST[post_mother]','$_POST[post_sex]', '$_POST[post_religion]',
				'$_POST[post_dob]','$_POST[post_blood]','$full_address',
				'$_POST[post_school]','$_POST[post_college]','$_POST[post_varsity]',
				'$_POST[post_job]','$_POST[post_mobile]',
				'$_POST[post_email]','$_POST[post_joined]')";
			$result = mysqli_query($con, $qry);

			if($result)
			{
				$message = "Successfull!";
				$sql = "SELECT * FROM members ORDER BY id DESC LIMIT 1";
				$res = mysqli_query($con,$sql);
				$row = mysqli_fetch_array($res);
				$id = $row[0];

				$filename = $_FILES['image']['name'];
				$file_type = $_FILES['image']['type'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$target = "mimages/".basename("$id."."$ext");
				//header('Refresh:2, url=index.php');
				if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
					//echo "Image uploaded Successfully";
				} else {
					//echo "Something went wrong";
				}
			} else{
				$message = "Opps! something went wrong";
			}
		} else {
			$message = "Member already exists";
		}
	}// endif addm
?>

<?php
	$n = $lang['m_name'];
	$no = $lang['m_no'];
	$f = $lang['mf_name'];
	$m = $lang['mm_name'];
	$r = $lang['m_religion'];
	$g = $lang['m_gen'];
	$g_m = $lang['m_gen_m'];
	$g_f = $lang['m_gen_f'];
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

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script language="javascript" type="text/javascript" src="script/preview.js"></script>
	<script language="javascript" type="text/javascript" src="script/main.js"></script>
</head>
<body>
	<div>
		<p align="center"><br/><br/></p>
		<p align="center"> <?php echo $message; ?></p>
	</div>
	<form class = "form-horizontal" action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<table id ="newUser" align="center">
			<tr>
				<td><?php echo $n.'*	' ?></td>
				<td><input type="text" name="post_name" required pattern="^[A-Za-z:._-/()]+" placeholder="<?php echo $n ?>"><br/></td>
				<td><?php echo $lang['m_img'] ?>
            <input type="file" onchange="showImage.call(this)" name="image"></td>
          <br/>
			</tr>
			<tr>
				<td><?php echo $no.'*	' ?></td>
				<td><input type="text" name="post_no" required pattern="^[0-9]+" placeholder="<?php echo $no ?>"><br/></td>
				<td rowspan="6"><div><img id="preview" style="display:none" height="200" width ="200" src=""></div>
 		    </td>
			</tr>
			<tr>
				<td><?php echo $f ?></td>
				<td><input type="text" name="post_father" pattern="^[A-Za-z:._-/()]+" placeholder="<?php echo $f ?>"><br/></td>
			</tr>
			<tr>
				<td><?php echo $m ?></td>
				<td><input type="text" name="post_mother" pattern="^[A-Za-z:._-/()]+" placeholder="<?php echo $m ?>"><br/></td>
			</tr>
			<tr>
				<td><?php echo $r ?></td>
				<td><input type="text" name="post_religion" pattern="^[A-Za-z:._-/()]+" placeholder="<?php echo $r ?>"><br/></td>
			</tr>
			<tr>
				<td><?php echo $g ?></td>
				<td><input type="radio" name="post_sex" value="Male" checked><?php echo $g_m ?>
					<input type="radio" name="post_sex" value="Female"><?php echo $g_f ?><br/></td>
			</tr>
			<tr>
				<td><?php echo $s ?></td>
				<td><input type="text" name="post_school" placeholder="<?php echo $s ?>"><br/></td>

			</tr>
			<tr>
				<td><?php echo $c ?></td>
				<td><input type="text" name="post_college" placeholder="<?php echo $c ?>"><br/></td>

			</tr>
			<tr>
				<td><?php echo $v ?></td>
				<td><input type="text" name="post_varsity" placeholder="<?php echo $v ?>"><br/></td>

			</tr>
			<tr>
				<td><?php echo $job ?></td>
				<td><input type="text" name="post_job" placeholder="<?php echo $job ?>"><br/></td>

			</tr>
			<tr>
				<td><?php echo $a ?></td>
				<td><select class="mads" name="distSelected" required>
					 <option value=""></option>
					 <option value="noakhali"><?php echo $lang['noakhali'];?></option>
					 <option value="abroad"><?php echo $lang['abroad'];?></option>
					 <option value="Others"><?php echo $lang['others'];?></option>
				</select></td>
			</tr>
			<tr>
				<td></td>
				<td><select class="madsd noakhali" name="unionSelected">
					 <option value="">Select Union/Pouroshova</option>
					 <option value="Basurhat"><?php echo $lang['basurhat'];?></option>
					 <option value="Char-Elahi"><?php echo $lang['charElahi'];?></option>
					 <option value="Char-Fakira"><?php echo $lang['charFakira'];?></option>
					 <option value="Char-Hazari"><?php echo $lang['charHazari'];?></option>
					 <option value="Char-Kakra"><?php echo $lang['charKakra'];?></option>
					 <option value="Char-Parbati"><?php echo $lang['charParbati'];?></option>
					 <option value="Musapur"><?php echo $lang['musapur'];?></option>
					 <option value="Rampur"><?php echo $lang['rampur'];?></option>
					 <option value="Sirajpur"><?php echo $lang['sirajpur'];?></option>
				 </select>
				 <select class="madsd abroad" name="countrySelected">
 					 <?php include 'countrylist.inc'; ?>
 					 </select>
			 </td>
			</tr>
			<tr>
				<td></td>
				<td><select class="mausd Basurhat Sirajpur Rampur Musapur Char-Parbati Char-Elahi Char-Fakira Char-Hazari Char-Kakra"
					name="wardSelected">
					 <option value=""></option>
					 <option value="01"><?php echo $lang['01w'];?></option>
					 <option value="02"><?php echo $lang['02w'];?></option>
					 <option value="03"><?php echo $lang['03w'];?></option>
					 <option value="04"><?php echo $lang['04w'];?></option>
					 <option value="05"><?php echo $lang['05w'];?></option>
					 <option value="06"><?php echo $lang['06w'];?></option>
					 <option value="07"><?php echo $lang['07w'];?></option>
					 <option value="08"><?php echo $lang['08w'];?></option>
					 <option value="09"><?php echo $lang['09w'];?></option>
					 </select></td>
			</tr>
			<tr>
				<td></td>
				<td><input class="addr_input" type="text" name="post_address"></td>
			</tr>
			<tr>
				<td><?php echo $mo ?></td>
				<td><input type="text" name="post_mobile" pattern="^[0-9+-]+" placeholder="<?php echo $mo ?>"><br/></td>

			</tr>
			<tr>
				<td><?php echo $b ?></td>
				<td><select id="mbgs" name="post_blood">
					 <option value="NA"></<option>
					 <option value="A+">A+</option>
					 <option value="A-">A-</option>
					 <option value="B+">B+</option>
					 <option value="B-">B-</option>
					 <option value="AB+">AB+</option>
					 <option value="AB-">AB-</option>
					 <option value="O+">O+</option>
					 <option value="O-">O-</option>
				</select><br/></td>
				<?php
					if($logged){
					?>
					<td><button id = "sub" name="addm"><?php echo $lang['m_add']; ?></button></td>
					<!-- <td><input id = "sub" type="submit" name="addm" value="<?php echo $lang['m_add']; ?>"></td> -->
				<?php }else{
					echo '<td><p>Please Log in, to add a member</p></td>';
				} ?>
			</tr>
			<tr>
				<td><?php echo $e ?></td>
				<td><input type="text" name="post_email" placeholder="<?php echo $e ?>"><br/></td>
			</tr>
			<tr>
				<td><?php echo $d ?></td>
				<td><input type="date" value="<?php echo ('1995-01-01'); ?>"
							name="post_dob" placeholder="<?php echo $d ?>"><br/></td>
			</tr>
			<tr>
				<td><?php echo $j ?></td>
				<td><input type="date" value="<?php echo date('Y-m-d'); ?>"
							name="post_joined" placeholder="<?php echo $j ?>"><br/></td>
			</tr>
			<tr>
				<!-- <td><?php echo $lang['m_img'] ?></td>
				<td><input type="file" onchange="showImage.call(this)" name="image">
				<div><img id= "preview" src="" style="display:none" height="200" width="180"/></div>
		    </td> -->
				<!-- <td><button id = "sub" onclick="saveimage()">Add</button></td> -->

			</tr>
		<br/><br/>
	</form>
</body>
</html>
