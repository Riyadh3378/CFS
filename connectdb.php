<?php
		$host = 'localhost';
		$user = 'root';
		$pass = '';
		$db = 'cfs';

		$con = new mysqli($host, $user, $pass, $db);

		if($con){
			//echo "Successfully connected to the database";
			//echo "<br>";
		}

		else{
			//die("Error! database not connected");
			//echo "<br>";
		}
		if($db){
			//echo"Successfully found the database";
			//echo "<br>";
		}
		else
			die("Error");
?>
