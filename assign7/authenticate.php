<?php
	session_start();
	
	$username = $_POST["username"];
	$password = $_POST["password"];

	$_SESSION["username"] = $username;
	
	if ($username == "aritzhaupt" && $password == "nicememe") {;
		header("Location: main.php");
		die();
	}
	else {
		header("Location: index.php?error=1");
		die();
	}
?>