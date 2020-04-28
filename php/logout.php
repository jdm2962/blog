<?php

	session_start();

	// echo "This script ran";
	if($_SESSION["user_logged_in"])
	{
		$_SESSION["user_logged_in"] = false;
		echo "logged out";
	}
	else
	{
		echo "egg";
	}

?>


