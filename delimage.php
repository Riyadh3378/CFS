<?php
	$fileName = $_GET['fina'];
	$f_count = $_GET['gid'];
	$redirect = "slid.php?gid=";
	$redirect .= $f_count;
	//echo $redirect;
	unlink($fileName);
	header("refresh:0; url=$redirect");
	exit;
?>
