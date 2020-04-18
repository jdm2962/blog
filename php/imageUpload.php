<?php

	include "db_functions.php";

	$target_dir = "img/";
	$target_file = $target_dir . basename($_FILES["image_upload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	$tmp = $_FILES["image_upload"]["tmp_name"];
	$f = $_FILES["image_upload"]["name"];
	echo "$tmp<br>";


	if($_FILES["image_upload"]["tmp_name"] !== "")
	{
		echo $tmp . "<br>";
		if (isset($_POST["submitForm"]))
		{
			// checking whether the file is an image or not
			$check = getimagesize($tmp);
			if ($check !== false)
			{
				// print_r(pathinfo($target_file));
				echo "File is an image- " . $check["mime"] . ".<br>";
				$uploadOk = 1;
			}
			else
			{
				echo "FIle is not an image.<br>";
				$uploadOk = 0;
			}
		

			// check whether there is aleady an image file in the img folder
			// if there is delete it and then upload the new one

			// clear all images from the image folder
			$dirName = "/var/www/html/blog/php/img";
			echo $dirName;
			$dir = new DirectoryIterator($dirName);
			$file = "";

			foreach ($dir as $fileinfo)
			{
				if (!$fileinfo -> isDot())
				{
					if (getimagesize($fileinfo -> getPath() . "/" . $fileinfo))
					{
						echo "File is an image<br>";
						$file = $fileinfo;
					
						// echo $fileinfo . " is an image<br>";;
						if (unlink($fileinfo -> getPath() . "/" . $fileinfo))
						{
							echo $fileinfo . " deleted.<br>";
						}
						else
					 	{
					 		echo "$fileinfo not deleted.<br>";
					 	}
					}
				}
			}
		}
		else
		{
			print_r($_POST);
		}


		// check whether the file exists already
		// if so replace it(VERIFY THAT IT ISN'T CHECKING BY ONLY NAME
				// if so don't bother)
		if (file_exists($target_file))
		{
			echo "Sorry, file already exists.<br>";
			$uploadOk = 0;
		}

		// check file size
		if ($_FILES["image_upload"]["size"] > 500000)
		{
			echo "Sorry your file is too large.<br>";
			$uploadOk = 0;
		}

		// allow only certain file formats
		if ($imageFileType != "jpeg"  && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jfif")
		{
			echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.<br>";
			$uploadOk = 0;
		}

		if ($uploadOk == 0)
		{
			echo "Sorry, your file was not uploaded.<br>";
		}
		else
		{


			// if everything else is good.. upload the file
			//move file to folder
			if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $target_file))
			{
				echo "The file " . basename($_FILES["image_upload"]["name"]) . " has been uploaded.<br>";
			}
			else
			{
				echo "Sorry, there was an error uploading your file.<br>";
			}

		}

	}

	// redirect user back to blog home
	header("location:/blog");

?>