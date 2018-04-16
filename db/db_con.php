<?php

	if(!$con = mysqli_connect("localhost", "root", "", "marychiles_db"))
	{
		echo "Cannot connect to the system database.";
	}

?>