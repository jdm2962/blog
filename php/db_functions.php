<?php
	include "../../../inc/dbinfo.inc";
?>


<?php

	// function to connect to db returns a handle
	function getDB($db_name)
	{
		$handle = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, $db_name);
		if($handle -> connect_error)
		{
			die("Error connecting to db." . $handle -> connect_error);
		}

		return $handle;
	} 

	// function to query database returns the results
	function queryDB($handle, $sql, $isMultiple = false)
	{
		if($isMultiple)
		{
			$result = $handle -> multi_query($sql);
		}

		else
		{
			$result = $handle -> query($sql);
		}
		
		if (!$result)
		{
			die("Error querying the db. Error: " . $handle -> error);
		}

		return $result;

	}


?>