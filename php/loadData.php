<?php

	include "db_functions.php";

	$dataList = [];

	$handle = getDB("real_blogDB");

	// get title and description for about section
	$sql = "SELECT title, description FROM aboutTable WHERE id = 1";

	$result = queryDB($handle, $sql);

	if ($result -> num_rows > 0)
	{
		$row = $result -> fetch_assoc();
		// print_r($row);
		// array_push($dataList, title, description);
		
		// $dataList["title"] = htmlentities($row["title"], ENT_HTML401, "UTF-8");
		// $dataList["description"] = htmlentities($row["description"], ENT_HTML401, "UTF-8");
	}

	// get title, subtitle, color, color2 for hero section
	$sql = "SELECT title, subtitle, color, color2, title_color, subtitle_color FROM heroTable WHERE id = 1";
	$result = queryDB($handle, $sql);
	if($result -> num_rows > 0)
	{
		$row = $result -> fetch_assoc();
		// $dataList["h_title"] = htmlentities($row["title"], ENT_HTML401, "UTF-8");
		// $dataList["h_subtitle"]  = htmlentities($row["subtitle"], ENT_HTML401, "UTF-8");
		$dataList["color"]  = $row["color"];
		$dataList["color2"]  = $row["color2"];
		$dataList["title_color"] = $row["title_color"];
		$dataList["subtitle_color"] = $row["subtitle_color"];
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