<!DOCTYPE html>
<?php
	error_reporting(0);
	include('admincheck.php');
	include('menu.html');
?>

<?php
$album_dir = getcwd();
$album = $_POST[album];
$album_dir .= "\\gallery\\";
$errors = array();
$uploadedFiles = array();
$extension = array("JPEG","jpeg","JPG","jpg","PNG","png","GIF","gif");
$bytes = 1024;
$KB = 1024;
$totalBytes = $bytes * $KB * 20;
$album_dir .= $album;
$UploadFolder = $album_dir;
if (!is_dir($UploadFolder)) {
    mkdir($UploadFolder, 0777, true);
}
//echo $UploadFolder;
//opendir($dir);

$counter = 0;

foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
    $temp = $_FILES["files"]["tmp_name"][$key];
    $name = $_FILES["files"]["name"][$key];

    if(empty($temp))
    {
        break;
    }

    $counter++;
    $UploadOk = true;

    if($_FILES["files"]["size"][$key] > $totalBytes)
    {
        $UploadOk = false;
        array_push($errors, $name." Upload size is larger than 20 MB.");
    }

    $ext = pathinfo($name, PATHINFO_EXTENSION);
    if(in_array($ext, $extension) == false){
        $UploadOk = false;
        array_push($errors, $name." is invalid file type.");
    }

    if(file_exists($UploadFolder."/".$name) == true){
        $UploadOk = false;
        array_push($errors, $name." file is already exist.");
    }

    if($UploadOk == true){
        move_uploaded_file($temp,$UploadFolder."/".$name);
        array_push($uploadedFiles, $name);
    }
}

if($counter>0){
    if(count($errors)>0)
    {
        echo "<b>Errors:</b>";
        echo "<br/><ul>";
        foreach($errors as $error)
        {
            echo "<li>".$error."</li>";
        }
        echo "</ul><br/>";
    }

    if(count($uploadedFiles)>0){
        echo "<b>Uploaded Files:</b>";
        echo "<br/><ul>";
        foreach($uploadedFiles as $fileName)
        {
            echo "<li>".$fileName."</li>";
        }
        echo "</ul><br/>";

        echo count($uploadedFiles)." file(s) are successfully uploaded.";
    }
}
else{
	if($logged){
		echo "Please, Select file(s) to upload.";
	}
}
?>

<html>
<head>
<title><?php echo $lang['gallery'] ?> </title>
<script type="text/javascript" src="script/slide.js"></script>
<link rel="stylesheet" href="css/slide.css" type="text/css" />
</head>
<body>
<?php
 if ($logged):?>
<div id="uploader">
<form method="post" enctype="multipart/form-data" name="formUploadPhoto">
	<label>Album Name:</label>
	<input type=""text" name="album" required pattern="^[A-Za-z0-9:._-/()]+"/>
    <label>Select Photo/s to upload:</label>
    <input type="file" name="files[]" multiple="multiple" />
    <input type="submit" value="Upload File" name="btnSubmit"/>
</form>
</div>
<?php

endif;
?>
<div id="slide_menu">
	<script>
function myFunction() {
    confirm("Press a button!");
}
</script>
	<?php
		$fold = '';
		$fcount = 0;
		$dir = new DirectoryIterator(__DIR__.'/gallery');
		foreach ($dir as $fileinfo) {
			if ($fileinfo->isDir() && !$fileinfo->isDot()) {
				$fold = $fileinfo->getFilename();
				$fcount++;
				echo '<ul style="list-style:none;">
				<li>
				<a href="slid.php?gid='.$fcount.'">'.$fileinfo->getFilename().'</a>';
				if ($logged):
				?><a href="delfolder.php?<?php echo 'gid='.$fcount; ?>"
					onclick="return confirm('Are you sure to delete <?php echo $fileinfo->getFilename();?>?')">
				<img src="data/icon-delete.png" alt="Delete Folder"></a><br/>
				</li>
				</ul><?php
				endif;
				//
				/* ?>
				<a href="slide.php?gid='<?php echo $fcount ?>'"><?php echo $fold ?></a><br/>
				<?php */

    }
}
	?>
</div>
</body>
</html>
