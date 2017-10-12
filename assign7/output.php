<?php
	session_start();
	
	$username = $_SESSION["username"];
	if($username == "") {
		header("Location: index.php?error=1");
		die();
	}

	// Create database connection
	$mysql_access = mysql_connect(localhost, "n00186780", "summer2017186780");
	
	// Verify connection
	if (!mysql_access)
		die("could not connect: ".mysql.error());
	
	// Select private database
	mysql_select_db("n00186780");
	$q = $_GET['q'];
	if ($q == '*'){
		$query = "SELECT * FROM Cars";
	}
	else{
		$query = "SELECT * FROM Cars WHERE carOrigin = '".$q."'";
	}
	$result = mysql_query($query, $mysql_access);
	echo "<form action ='' method='get' name='table'>";
	echo "<table class='table table-striped'>" ;
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>Year</th>";
	echo "<th>Make</th>";
	echo "<th>Model</th>";
	echo "<th>Options</th>";
	echo "<th>VIN</th>";
	echo "<th>Style</th>";
	echo "<th>Mileage</th>";
	echo "<th>Origin</th>";
	echo "<th>Weight</th>";
	echo "<th>Horsepower</th></tr>";
	while($row = mysql_fetch_row($result))
	{
		$carID = $row[0];
		$carYear = $row[1];
		$carMake = $row[2];
		$carModel = $row[3];
		$carOption = $row[4];
		$carVIN = $row[5];
		$carStyle = $row[6];
		$carMileage = $row[7];
		$carOrigin = $row[8];
		$carWeight = $row[9];
		$carHP = $row[10];
		
		echo "<tr>";
		echo "<td><input type='radio' name='carID' value='$carID'</td>";
		echo "<td>$carYear</td>";
		echo "<td>$carMake</td>";
		echo "<td>$carModel</td>";
		echo "<td>$carOption</td>";
		echo "<td>$carVIN</td>";
		echo "<td>$carStyle</td>";
		echo "<td>$carMileage</td>";
		echo "<td>$carOrigin</td>";
		echo "<td>$carWeight</td>";
		echo "<td>$carHP</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "</form>";
	mysql_close($mysql_access);
?>