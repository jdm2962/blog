<?php

	//get image 
	$dirName = "/var/www/html/blog/php/img";
	$dir = new DirectoryIterator($dirName);

	foreach($dir as $file)
	{
		if(!$file -> isDot())
		{
			// echo "$file<br>";
			if(getimagesize($file -> getPath() . "/" . $file))
			{
				echo "<img src = img/" . $file .">";
			}
			else
			{
				// echo "Didn't get it";
			}
		}
	}

	// send image

	

?>