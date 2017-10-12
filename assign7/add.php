<?php
	session_start();
	
	$username = $_SESSION["username"];
	if($username == "") {
		header("Location: index.php?error=1");
		die();
	}
	$servername = 'localhost';
	$user = 'n00186780';
	$password = 'summer2017186780';
	$dbname = 'n00186780';
	
	// Create DB connection
	$mysql_access = new mysqli($servername, $user, $password, $dbname);
	
	// Verify connection
	if ($mysql_access_connect_errno)
		printf("Could not connect: %s\n", $mysql_access_connect_error());
	
	// Prepared statement to prevent SQL injection
	$stmt = $mysql_access->prepare("INSERT INTO Cars (carYear, carMake, carModel, carOption, carVIN, carStyle, carMileage, carOrigin, carWeight, carHP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	if( isset($_POST["carOption"])) {
		$stmt->bind_param('isssssisii', $_POST["carYear"], $_POST["carMake"], $_POST["carModel"], implode(",", $_POST["carOption"]), $_POST["carVIN"], $_POST["carStyle"], $_POST["carMileage"], $_POST["carOrigin"], $_POST["carWeight"], $_POST["carHP"]);
	}
	else {
		$stmt->bind_param('isssssisii', $_POST["carYear"], $_POST["carMake"], $_POST["carModel"], $_POST["carOption"], $_POST["carVIN"], $_POST["carStyle"], $_POST["carMileage"], $_POST["carOrigin"], $_POST["carWeight"], $_POST["carHP"]);
	}
	if($stmt === FALSE) {
		//die("Error: ".mysql_error()); // TODO: better error handling
		$stmt->close();
		$mysql_access->close();
		header("Location: main.php?status=1");
		die();
	}
	$stmt->execute();
	
	$stmt->close();
	$mysql_access->close();
	
	header("Location: main.php?status=3");
	
	?>
	