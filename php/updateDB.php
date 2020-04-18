<?php

	include "db_functions.php";		
		
	$handle = getDB("real_blogDB");

	$sql = "CREATE TABLE IF NOT EXISTS aboutTable(
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			title VARCHAR(100) NOT NULL,
			description TEXT NOT NULL
	)";

	// create table
	$result = queryDB($handle, $sql);

	$sql = "CREATE TABLE IF NOT EXISTS images(
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			image VARBINARY(1073741824) NOT NULL
	)";

	$result = queryDB($handle, $sql);

	// put default values in table
	// $sql = "INSERT INTO aboutTable (title, description)
	// 		VALUES ('Default title', 'Default description')";


	// respond to ajax request
	$updateList = [];
	$json_updateList = json_decode($_REQUEST["json"]);

	if ($json_updateList)
	{
		foreach ($json_updateList as $key => $value)
		{

			$sql = "UPDATE aboutTable
					SET $key = ?
					WHERE id = 1";

			$stmt = $handle -> prepare($sql);
			$stmt -> bind_param("s", $value);
			$stmt -> execute();

			$updateList[$key] = htmlentities($value, ENT_QUOTES | ENT_HTML401);
		}

		echo json_encode($updateList);
	}



	// close handle
	$handle -> close();
?>