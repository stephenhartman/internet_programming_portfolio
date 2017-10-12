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
	$query = "UPDATE Cars SET carYear = ?, carMake = ?, carModel = ?, carOption = ?, carVIN = ?, carStyle = ?, carMileage = ?, carOrigin = ?, carWeight = ?, carHP = ? WHERE carID = ?";
	$stmt = $mysql_access->prepare($query);
	if( isset($_POST["carOption"])) {
		$stmt->bind_param('isssssisiii', $_POST["carYear"], $_POST["carMake"], $_POST["carModel"], implode(",", $_POST["carOption"]), $_POST["carVIN"], $_POST["carStyle"], $_POST["carMileage"], $_POST["carOrigin"], $_POST["carWeight"], $_POST["carHP"], $_POST["carID"]);
	}
	else {
		$carOption = (isset($_POST['carOption'])) ? $_POST['carOption'] : '' ;
		$stmt->bind_param('isssssisiii', $_POST["carYear"], $_POST["carMake"], $_POST["carModel"], $carOption, $_POST["carVIN"], $_POST["carStyle"], $_POST["carMileage"], $_POST["carOrigin"], $_POST["carWeight"], $_POST["carHP"], $_POST["carID"]);
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
	
	header("Location: main.php?status=4");
?>
	