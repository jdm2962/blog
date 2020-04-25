<?php

	include "db_functions.php";

	//db handle
	$handle = getDB("real_blogDB");

	// create table
	// $sql = "CREATE TABLE IF NOT EXISTS heroTable(
	// 		id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	// 		title VARCHAR(100) NOT NULL,
	// 		subtitle VARCHAR(100) NOT NULL,
	// 		color VARCHAR(100)
	// 	)";

	// $result = $handle -> query($sql);
	// if($result)
	// {
	// 	// echo "table created";
	// }
	// else
	// {
	// 	echo "Error creating table :" . $handle -> error;
	// }

	// add second color to hero table
	// $sql = "ALTER TABLE heroTable
	// 		ADD subtitle_color varchar(100)";
	// if($handle -> query($sql))
	// {
	// 	echo "table altered";
	// }
	// else
	// {
	// 	echo "Error: " . $handle -> error;
	// }

	// title_color
	// subtitle_color


	
	// first entry..dummy data
	// $sql = "INSERT INTO heroTable (title, subtitle, color)
	// 		VALUES ('dummy title', 'dummy subtitle', '#fff')";
	// if($result = $handle -> query($sql))
	// {
	// 	echo "data entered";
	// }
	// else
	// {
	// 	echo "Error : " . $handle -> error;
	// }



	// query db w/ entry
	$json_updateList = json_decode($_REQUEST["json"], true);
	// echo $json_updateList;
	// $testList = ["title" => "New Title", "subtitle" => "New Subtitle", "color" => "#ccc", "color2" => "#aaa"];

	foreach($json_updateList as $key => $value)
	{
		// either test for if an entry is there for each 
		// or just update db seperately for each...maybe not good?
		$sql = "UPDATE heroTable
				SET $key = ?
		    	WHERE id = 1";
		$stmt = $handle -> prepare($sql);
		$stmt -> bind_param("s", $value);
		$stmt -> execute();

	}
	



	// update with actual data.. only update from here on after
	// only need the one column
	// $stmt = $handle -> prepare($sql);


	// test
	$sql = "SELECT * FROM heroTable";
	$result = $handle -> query($sql);
	if($result -> num_rows > 0)
	{
		echo "<br>";
		while($row = $result -> fetch_assoc())
		{
			echo $row["title"] . "<br>";
			echo $row["subtitle"] . "<br>";
			echo $row["color"] . "<br>";
			echo $row["color2"] . '<br>';
			echo $row["title_color"] . '<br>';
			echo $row["subtitle_color"] . '<br>';
		}
	}


	// close handle, stmt
	$handle -> close();

	$list = ["color" => "#sdfff"];
	$json_list = json_encode($list);
	// echo $json_list . "<br>";
	$j = json_decode($json_list, true);
	echo gettype($j); 
	foreach($list as $key => $value)
	{
		echo "$key => $value";
	}



	
	// if($json_updateList)
	// {
	// 	echo json_encode($_REQUEST["json"]);
	// }
	// else
	// {
	// 	echo "No json";
	// }

?>