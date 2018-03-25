<!DOCTYPE html>
<?php
	error_reporting(0);
	include('admincheck.php');
	include("menu.html");
	$f_count = $_GET['gid'];
	$fold = '';
	$npath = '';
		$fcount = 0;
		$dir = new DirectoryIterator(__DIR__.'/gallery');
		foreach ($dir as $fileinfo) {
			if ($fileinfo->isDir() && !$fileinfo->isDot()) {
				$fcount++;
				if ($f_count == $fcount){
					$fold = $fileinfo->getFilename();
					$npath = "gallery/".$fold;
					//echo $npath;
				}
			}
		}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="script/slide.js"></script>
<title><?php echo $fold ?></title>
<link rel="stylesheet" href="css/slide.css" type="text/css" />
</head>
<body>
<?php
	  $dir = new DirectoryIterator($npath);
	  $file = fopen("$npath/slide.js","w");
	  fwrite($file,"var viewer = new PhotoViewer();");
	  $extension = array("JPEG","jpeg","JPG","jpg","PNG","png","GIF","gif");
		if($logged){
			echo "<a href='addimage.php?fona=$npath'>
						<img src='data/icons-imgadd.png' alt='Add Image'>
						</a>";
					}
		?>
		<script type="text/javascript" src="gallery/<?php echo $fold ?>/slide.js"></script>
		<p></p>
		<h3>Click The Below Icon To Watch The Slide Show.</h3>
		<a id="sslink" href="javascript:void(viewer.show(0))">
		<img src="data/icon-slide.png" alt="Start Slide Show"></a>
		<?php
	  foreach ($dir as $imageFile) {
			if ($imageFile->isFile()) {
        $path = pathinfo($imageFile);
        $imgname = $path['filename'];
				$imgext = $path['extension'];
				if(in_array($imgext, $extension) == true){
					$file = fopen("$npath/slide.js","a");
					fwrite($file,"
					viewer.add('$npath/$imgname.$imgext');
					");
					fclose($file);
					if(!$logged){
						echo "<div id='album_item'><ul style='list-style:none;float:left;'>
						<li><img src='$npath/$imgname.$imgext' alt='$imgname.$imgext' width='120' height='120'>
						</li></ul>";
					}
					?><?php
							if($logged){
								echo "<div id='album_item'><ul style='list-style:none;float:left;'>
								<li><img src='$npath/$imgname.$imgext' alt='$imgname.$imgext' width='120' height='120'>";
								echo "<a href='delimage.php?fina=$npath/$imgname.$imgext&gid=$f_count'
									onclick='return confirm(\"Are you sure to delete this photo?\")'>
									<img id='delicon' src='data/icon-delete.png' alt='Delete' width='14' height='18'>
									</a>
									</li>
									</ul>
									</div>";
						}
					}
        }
      }
		?>
</body>
</html>
