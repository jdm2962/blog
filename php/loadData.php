<?php

	include "db_functions.php";

	$dataList = [];

	$handle = getDB("real_blogDB");


	// get color, color2, title and subtitle colors for hero section
	$sql = "SELECT color, color2, title_color, subtitle_color FROM heroTable WHERE id = 1";
	$result = queryDB($handle, $sql);
	if($result -> num_rows > 0)
	{
		$row = $result -> fetch_assoc();
		$dataList["color"]  = $row["color"];
		$dataList["color2"]  = $row["color2"];
		$dataList["title_color"] = $row["title_color"];
		$dataList["subtitle_color"] = $row["subtitle_color"];
	}

	// return list of data
	echo json_encode($dataList);

?>