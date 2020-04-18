<?php

	session_start();

	if ($_SESSION["user_logged_in"])
	{
		echo "User is logged in";
	}
	else
	{
		echo "Not logged in";
	}


?>