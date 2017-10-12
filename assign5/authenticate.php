<?php
	session_start();
	
	$username = $_POST["username"];
	$password = $_POST["password"];

	$_SESSION["username"] = $username;
	
	if ($username == "aritzhaupt" && $password == "nicememe") {
		$userfile = fopen("userdata.dat", "a");
		fwrite($userfile, "$username,$password\n");
		fclose($userfile);
		header("Location: stock.php");
		die();
	}
	else {
		header("Location: index.php?error=1");
		die();
	}
?>