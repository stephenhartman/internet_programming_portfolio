<?php
session_start();

$username = $_SESSION["username"];
if ($username == "") {
	header("Location: index.php?error=1");
	die();
}
	
session_destroy();
header('Location: index.php?error=2');
exit;

?>