<?php
  error_reporting(0);
  include("admincheck.php");
  include("menu.html");
  $sql = "SELECT * FROM members";
  $records = mysqli_query($con,$sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- <link rel="shortcut icon" href="logo.png" type="image/x-icon"/> -->
    <title><?php echo $lang['all_member']?></title>
    <!-- Bootstrap -->
    <link href="bootstrap337dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap337dist/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<p><br/></p>
    <div class="container">
      <table class="table table-striped table-bordered table-hover" id="mydata">
        <thead>
          <tr>
          	<th><?php echo $lang['m_no'] ?></th>
			<th><?php echo $lang['m_name'] ?></th>
			<!--<th><?php echo $lang['mf_name'] ?></th>
			<th><?php echo $lang['mm_name'] ?></th>
			<th><?php echo $lang['m_religion'] ?></th>
			<th><?php echo $lang['m_gen'] ?></th> 
			<th><?php echo $lang['m_dob'] ?></th>-->
			<th><?php echo $lang['m_address'] ?></th>
			<th><?php echo $lang['m_school'] ?></th>
			<th><?php echo $lang['m_college'] ?></th>
			<th><?php echo $lang['m_varsity'] ?></th>
			<th><?php echo $lang['m_job'] ?></th>
			<th><?php echo $lang['m_bg'] ?></th>
			<?php
			if ($logged): ?>
			<th><?php echo $lang['m_mobile'] ?></th>
			<?php endif ?>
			<th><?php echo $lang['m_email'] ?></th>
			<th><?php echo $lang['m_join'] ?></th>
			<th><?php echo $lang['m_img'] ?></th>
			<?php if ($logged) : ?>
              <th>Action</th>
            <?php endif; ?>
        	</tr>
        </thead>
        <tfoot>
          
        </tfoot>
        <tbody>
          <?php
          while($row = mysqli_fetch_array($records)){
            echo "<tr>";
            $member=$row['id'];
            echo "<td>".$row['no']."</td>";
			echo "<td>".$row['name']."</td>";
			/* echo "<td>".$row['father']."</td>";
			echo "<td>".$row['mother']."</td>";
			echo "<td>".$row['religion']."</td>";
			echo "<td>".$row['sex']."</td>"; 
			echo "<td>".$row['dob']."</td>";*/
			echo "<td>".$row['address']."</td>";
			echo "<td>".$row['school']."</td>";
			echo "<td>".$row['college']."</td>";
			echo "<td>".$row['varsity']."</td>";
			echo "<td>".$row['job']."</td>";
			echo "<td>".$row['blood']."</td>";
			if ($logged){
				echo "<td>".$row['mobile']."</td>";
			}
			
			echo "<td>".$row['email']."</td>";
			echo "<td>".$row['joined']."</td>";
			foreach (new DirectoryIterator(__DIR__.'/mimages') as $file) {
              if ($file->isFile()) {
            			$path = pathinfo($file);
            			$imgname = $path['filename'];
                  if($imgname == $row['id']){
                    $imgext = $path['extension'];
                  }
              }
            }
			?>
            <td><img height="50" width ="50" src="mimages/<?php echo $row['id'].'.'.$imgext ?>"</td>
            <?php
			if ($logged) :
              echo "<td>"."<a id='medit' href='medit.php?id=$member'>Edit/</a>"."<br/>".
                    "<a id='medit' href='mview.php?id=$member'>View</a>"."</td>";
            else :
              echo "";
            endif;
            echo "</tr>";
           }
           ?>
        </tbody>
      </table>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap337dist/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap337dist/js/bootstrap.min.js"></script>
    <script src="bootstrap337dist/js/jquery.dataTables.min.js"></script>
    <script src="bootstrap337dist/js/dataTables.bootstrap.min.js"></script>
    <script>
    $('#mydata').dataTable();
    </script>
  </body>
</html>
