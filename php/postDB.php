<?php
	
	include "../../../inc/dbinfo.inc"

?>

<?php

	// connect
	$handle = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, "real_blogDB");

	if ($handle -> connect_error)
	{
		die("Error: " . $handle -> connect_error);
	}
	else
	{
		echo "Connection to DB successful<br>";
	}

	// create table
	$sql = "CREATE TABLE IF NOT EXISTS BlogPost (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			title VARCHAR(255) NOT NULL,
			post TEXT NOT NULL,
			date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";

	if ($handle -> query($sql))
	{
		echo "Table created successfully";
	}
	else
	{
		echo "Table not created. Error: " . $handle -> error;
	}


	// handle form data and input data into database
	$title = $_POST["title"];
	$post = $_POST["post"];

	if ($title && $post)
	{
		$sql = "INSERT INTO BlogPost (title, post)
				VALUES (?, ?)";

		$stmt = $handle -> prepare($sql);
		if (isset($stmt))
		{
			echo "prepare ready";
		}
		else
		{
			echo "Prepare not ready";
		}

		if (!$stmt -> bind_param("ss", $title, $post))
		{
			echo "Binding failed. Error: " . $stmt -> error;
		}
		else
		{
			echo "Binding Successful";
		}

		if (!$stmt -> execute())
		{
			echo "Execute failed: " . $stmt -> error;
		}
		else
		{
			echo "Execute Successful";
			header("location: ../../blog");
		}





		// if ($handle -> query($sql))
		// {
		// 	echo "<br>Post entered!";
		// 	header('location: ../../blog');
		// }
		// else
		// {
		// 	echo "<br>Post not entered! :<";
		// 	if($handle -> error)
		// 	{
		// 		echo "<br>Error" . $handle -> error;
		// 	}
		// }
	}

	else
	{
		header("location: ../postcreation.php");
	}
	

	$handle -> close();

?>
