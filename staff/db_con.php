<?php

	date_default_timezone_set("Asia/Manila");
	
	if(!$con = mysqli_connect("localhost", "root", "", "marychiles_db"))
	{
		echo "Cannot connect to the system database.";
	}

?>