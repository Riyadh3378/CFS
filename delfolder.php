<?php
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
	
	function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}
	deleteDirectory($npath);
	header("refresh:1; url=gallery.php");
?>