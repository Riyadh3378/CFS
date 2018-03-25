<!DOCTYPE html>
<?php
	error_reporting(0);
	include('admincheck.php');
	include('menu.html');
	$sql = "SELECT * FROM members";
	//$sql = "SELECT * FROM members";
	$records = mysqli_query($con,$sql);

?>

<?php
      
?>
