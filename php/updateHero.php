<?php

	$json_updateList = json_decode($_REQUEST["json"]);
	if($json_updateList)
	{
		echo json_encode($json_updateList);
	}
	else
	{
		echo "Didn't get anything!";
	}

?>