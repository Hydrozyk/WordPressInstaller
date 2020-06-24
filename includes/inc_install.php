<?php
	echo '<pre>';
	echo '<span style="color:blue">DOWNLOADING WORDPRESS...</span>'.PHP_EOL;

	// Download WP file
	file_put_contents('wp.zip', file_get_contents('http://wordpress.org/latest.zip'));

	$srv = srv_name();

	//Unzipping WP .zip package
	$zip = new ZipArchive();
	$res = $zip->open('wp.zip');
	if ($res === TRUE) {


		$zip->extractTo( './');
		$zip->close();
		unlink('wp.zip');

		// Copy files from wordpress dir to current dir
		$files = find_all_files("wordpress");
		$source = "wordpress/";
		foreach ($files as $file) {
			$file = substr($file, strlen("wordpress/"));
			if (in_array($file, array(".",".."))) continue;
			if (!is_dir($source.$file)){
				rename($source.$file, $file);
			}else{
				@mkdir($file);
			}
		}
		//Outputting installed files
		echo "<div class=\"pre-scrollable\">";
		for ( $i = 0; $i <= count($files); ++$i) {
			echo '[DIR]  '. $files[$i] . PHP_EOL;
		}
		echo "</div>";

		// Remove wordpress dir
		foreach ($files as $file) {
			if (in_array($file, array(".",".."))) continue;
			if (is_dir($file)){
				@rmdir($file);
			}
		}
		@rmdir('./wordpress');

		// Check if copy was successful
		if(file_exists('index.php')){
			echo "<strong>Done</strong><br /><br />";
			echo "<hr />";
			echo "<div class=\"alert alert-success\" role=\"alert\">";
			echo "<p><a href=\"$srv$userWPDir\" class=\"btn btn-success\" target=\"_blank\" > Go to new WP site</a></p>";
			echo "<p><a href=\"#wp_form\" class=\"btn btn-info\" > Create another WP site</a></p>";
			echo "</div>";
		}else{
			echo "Something went wrong";
		}
	} else {
		echo "Something went wrong";
	}

?>
