<?php

	include "db_functions.php";

	$dataList = [];

	$handle = getDB("real_blogDB");

	// get title and description
	$sql = "SELECT title, description FROM aboutTable WHERE id = 1";

	$result = queryDB($handle, $sql);

	if ($result -> num_rows > 0)
	{
		$row = $result -> fetch_assoc();
		// print_r($row);
		// array_push($dataList, title, description);
		
		$dataList["title"] = $row["title"];
		$dataList["description"] = $row["description"];
	}

	

	// get image
	// $sql = "SELECT image 
	// 		FROM images 
	// 		WHERE id = 1";

	// $result = queryDB($handle, $sql);
	// if($result -> num_rows > 0)
	// {
	// 	$row = $result -> fetch_assoc();
	// 	$dataList["image"] = $row["image"];
	// 	echo $row["image"];
	// }


	echo json_encode($dataList);



?>