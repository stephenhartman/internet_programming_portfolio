<?php
	session_start();
	
	$username = $_SESSION["username"];
	if($username == "") {
		header("Location: index.php?error=1");
		die();
	}
	
	// Capture ID
	$carID = $_GET["carID"];
	
	// Create database connection
	$mysql_access = mysql_connect(localhost, "n00186780", "summer2017186780");
	
	// Verify connection
	if (!mysql_access)
		die("could not connect: ".mysql.error());
	
	// Select private database
	mysql_select_db("n00186780");
	
	$query = "DELETE FROM Cars WHERE carID =".$carID;
	$result = mysql_query($query, $mysql_access);
	
	if($result === FALSE) {
		//die("Error: ".mysql_error()); // TODO: better error handling
		mysql_close($mysql_access);
		header("Location: main.php?status=1");
	}
	mysql_close($mysql_access);
	
	header("Location: main.php?status=2");
	?>
	